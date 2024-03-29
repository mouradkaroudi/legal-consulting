<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\ProfessionSubscriptionPlan;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal;
use AmrShawky\LaravelCurrency\Facade\Currency;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\User;
use App\Services\TransactionService;

class PayPalController extends Controller
{

    public function checkout(Request $request)
    {

        // TODO: consider to add authorization

        $entities = ['subscription', 'order'];

        $entity = $request->input('entity');

        if (!in_array($entity, $entities)) {
            abort(404);
        }

        $cancel_url = $request->input('cancel_url');
        $id = $request->input('id');

        if ($entity === 'subscription') {
            $plan = ProfessionSubscriptionPlan::find($id);
            $currentOffice = $request->user()->currentOffice;
            
            if(!$currentOffice) {
                abort(404);
            }

            if($currentOffice->profession_id != $plan->profession_id) {
                abort(404);
            }

            $amount = $plan->total_amount;
            $tax = $plan->tax_amount;
        }

        if ($entity === 'order') {
            $order = Order::find($id);
            $this->authorize('view', $order);

            $amount = $order->total_amount;
            $tax = $order->tax_amount;
        }

        $provider = new PayPal();
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();

        $amountUSD = Currency::convert()->from('SAR')->to('USD')->amount($amount)->round(2)->get();
        $taxUSD = Currency::convert()->from('SAR')->to('USD')->amount($tax)->round(2)->get();

        $data = [
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('payment.paypal.process', ['entity' => $entity, 'id' => $id]),
                "cancel_url" => $cancel_url,
            ],
            "purchase_units" => [
                0 => [
                    "custom_id" => json_encode(['actual_amount' => $amount - $tax, 'tax' => $tax]),
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $amountUSD,
                    ],
                    "breakdown" => [
                        "tax_total" => [
                            "value" => $taxUSD
                        ]
                    ]
                ]
            ]
        ];

        $order = $provider->createOrder($data);

        foreach ($order['links'] as $links) {
            if ($links['rel'] == 'approve') {
                return redirect()->away($links['href']);
            }
        }
    }

    public function process(Request $request)
    {
        $provider = new PayPal();
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);

        $entity = $request->input('entity');
        $id = $request->input('id');

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {

            $custom_id = json_decode($response['purchase_units'][0]['payments']['captures'][0]['custom_id']);
            $actualAmount = $custom_id->actual_amount;
            $tax = $custom_id->tax;
            $user = auth()->user();

            TransactionService::deposit(User::find($user->id), [
                'amount' => $actualAmount,
                'actual_amount' => $actualAmount + $tax,
                'fees' => $tax,
                'status' => Transaction::SUCCESS, 
                'metadata' => ['payment_method' => 'paypal']
            ]);

            if($entity === 'order') {
                return redirect()->route('account.orders.pay', ['order' => $id])->with('success', __('Congratulations, the amount was successfully deposited with your account. You can now complete the payment'));
            }

            if($entity === 'subscription') {
                return redirect()->route('office.subscription.index', ['profession_subscription_plan' => $id])->with('success', __('Congratulations, the amount was successfully deposited with your account. You can now complete the payment'));
            }
            
        } else {
            return redirect()->route('account.orders.index')->withErrors([
              'message' => __("Sorry! we're unable to process this payment")
            ]);
        }
    }


}
