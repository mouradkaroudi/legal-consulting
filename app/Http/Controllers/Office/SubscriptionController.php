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
    public function index(Request $request)
    {
        return view('pages.office.subscription.index');
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

        if ($professionSubscriptionPlan->amount > $payer->available_balance) {
            return redirect()->route('office.subscription.index')->withErrors([
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

        if ($office->status == DigitalOffice::AVAILABLE || $office->status == DigitalOffice::BUSY) {
            return redirect()->route('office.subscription.success');
        }

        if (setting('digital_office_direct_registration') == 1) {
            $office->status = DigitalOffice::AVAILABLE;
        } else {
            $office->status = DigitalOffice::PENDING;
        }

        $office->save();

    }

}
