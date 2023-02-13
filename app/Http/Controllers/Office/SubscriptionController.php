<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use App\Models\DigitalOffice;
use App\Models\ProfessionSubscriptionPlan;
use App\Models\Transaction;
use App\Services\SubscriptionService;
use App\Services\TransactionService;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, ProfessionSubscriptionPlan $professionSubscriptionPlan)
    {
        return view('pages.office.subscription.index', [
            'plan' => $professionSubscriptionPlan
        ]);
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function select(Request $request)
    {
        $plans = ProfessionSubscriptionPlan::where('profession_id', $request->user()->currentOffice->profession_id)->get();

        return view('pages.office.subscription.select', [
            'plans' => $plans ?? []
        ]);
    }


    /**
     * Handle subscribe to a profession plan request.
     */
    public function subscribe(Request $request, ProfessionSubscriptionPlan $professionSubscriptionPlan)
    {
        
        $from = $request['from'] ?? 'account';

        $payer = $from === 'account' ? auth()->user() :  auth()->user()->currentOffice;

        if (empty($payer)) {
            return response('', 400);
        }

        $planId = $professionSubscriptionPlan->id;

        $professionSubscriptionPlan = ProfessionSubscriptionPlan::find($planId);

        // FIXME: move this to Transaction service
        if ($professionSubscriptionPlan->amount > $payer->available_balance) {
            return redirect()->route('office.subscription.index', ['profession_subscription_plan' => $professionSubscriptionPlan->id])->withErrors([
                'message' => __("Insufficient account balance. Please try another payment method")
            ]);
        }

        TransactionService::subscribe(
            $payer,
            $professionSubscriptionPlan->amount,
            Transaction::SUCCESS,
            ['subscription_plan' => $professionSubscriptionPlan->id]
        );

        SubscriptionService::createSubscription(
            $payer instanceof DigitalOffice ? $payer : $payer->currentOffice,
            $professionSubscriptionPlan
        );

        $office = $request->user()->currentOffice;
        $office->status = DigitalOffice::AVAILABLE;
        if (setting('digital_office_direct_registration') == 1) {
            
        } else {
            //$office->status = DigitalOffice::PENDING;
        }

        $office->save();

        return redirect()->route('office.settings',['tab' => 'subscription'])->with(
            'success',
            __("Congratulation! You have been subscribed")
        );
    }
}
