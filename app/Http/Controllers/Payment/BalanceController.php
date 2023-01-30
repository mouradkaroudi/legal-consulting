<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\DigitalOffice;
use App\Models\Order;
use App\Models\ProfessionSubscriptionPlan;
use App\Models\Subscription;
use App\Models\Transaction;
use App\Services\SubscriptionService;
use Illuminate\Http\Request;

class BalanceController extends Controller
{

    public function subscription(Request $request)
    {

        $from = $request['from'] ?? 'account';

        $holder = $from === 'account' ? auth()->user() :  auth()->user()->currentOffice;

        if (empty($holder)) {
            return response('', 400);
        }

        $params = $request['params'] ?? [];

        $plan_id = $params['plan_id'];

        $professionSubscriptionPlan = ProfessionSubscriptionPlan::find($plan_id);

        if ($professionSubscriptionPlan->fee > $holder->available_balance) {
            return redirect()->route('office.subscription.failed');
        }

        $txn = $holder->transactions()->create([
            'amount' => $professionSubscriptionPlan->fee,
            'type' => 'credit',
            'source' => Transaction::PAY_DUES,
            'status' => Transaction::SUCCESS,
            'metadata' => json_encode(['subscription_plan' => $professionSubscriptionPlan->id])
        ]);

        $holder->substractFromBalance($professionSubscriptionPlan->fee);

        SubscriptionService::createSubscription(
            $holder instanceof DigitalOffice ? $holder : $holder->currentOffice,
            $professionSubscriptionPlan
        );

        return redirect()->route('office.subscription.success');
    }

    public function order() {

        $user = auth()->user();

        $params = $request['params'] ?? [];

        $order_id = $params['order_id'];

        $order = Order::find($order_id);

        if ($order->fee > $user->available_balance) {
            return redirect()->route('account.order.failed'); // TODO: consider make route for all failing payment
        }

        $office = $order->office;

        $user->transactions()->create([
            'amount' => $order->fee,
            'type' => 'credit',
            'source' => Transaction::PAY_DUES,
            'status' => Transaction::SUCCESS,
            'metadata' => json_encode(['order_id' => $order->id])
        ]);

        $office->transactions()->create([
            'amount' => $order->fee,
            'type' => 'debit',
            'source' => Transaction::RECEIVE_EARNINGS,
            'status' => Transaction::SUCCESS,
            'metadata' => json_encode(['order_id' => $order->id])
        ]);

        $user->substractFromBalance($order->fee);
        $office->addToBalance($order->fee);

        return redirect()->route('account.order.paid');

    }

}
