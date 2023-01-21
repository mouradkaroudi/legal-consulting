<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\ProfessionSubscriptionPlan;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal;
use AmrShawky\LaravelCurrency\Facade\Currency;

class PayPalController extends Controller
{

    /**
     * 
     */
    public function subscription(Request $request) {

        $plan_id = $request['plan_id'];

        $professionSubscriptionPlan = ProfessionSubscriptionPlan::find($plan_id);

        $provider = new PayPal();
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();

        $fee = Currency::convert()
        ->from('SAR')
        ->to('USD')
        ->amount($professionSubscriptionPlan->fee)
        ->round(2)
        ->get();
        $order = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('office.subscription.success', ['plan_id' => $professionSubscriptionPlan->id]),
                "cancel_url" => route('office.subscription.index'),
            ],
            "purchase_units" => [
                0 => [
                    "custom_id" => json_encode(['user_id' => auth()->user()->id]),
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $fee
                    ]
                ]
            ]
        ]);
        
        // redirect to approve href
        foreach ($order['links'] as $links) {
            if ($links['rel'] == 'approve') {
                return redirect()->away($links['href']);
            }
        }

    }

    public function order(Request $request) {

    }

    /**
     * Handle PayPal webhooks request
     */
    public function webhook(Request $request) {

    }
}
