<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\ProfessionSubscriptionPlan;
use App\Models\Transaction;
use Illuminate\Http\Request;

class BalanceController extends Controller
{
    
    public function subscription(Request $request) {

        
        $office = auth()->user()->currentOffice;

        if(empty($office)) {
            return response('', 400);
        }

        $params = $request['params'] ?? [];

        $plan_id = $params['plan_id'];

        $professionSubscriptionPlan = ProfessionSubscriptionPlan::find($plan_id);

        if ($professionSubscriptionPlan->fee > $office->available_balance) {
            return redirect()->route('office.subscription.failed');
        }

        $txn = Transaction::create([
            'amount' => $professionSubscriptionPlan->fee,
            'type' => 'credit',
            'source' => Transaction::PAY_DUES,
            'status' => Transaction::SUCCESS,
            'metadata' => ['subscription_plan' => $professionSubscriptionPlan->id]
        ]);

        $office->substractFromBalance($professionSubscriptionPlan->fee);

        return redirect()->route('office.subscription.success');

    }

}
