<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Subscription;
use Illuminate\Http\Request;

// one payment form
// generate callback url
// separate payment interface

// make controller for balance payment

class PaymentService
{

    public $amount = 0;
    public $paymentMethod = '';

    public function setAmount() {

    }

    public function balance( $holder, $order ) {

    }

    /**
     * Process a payment for an order.
     *
     * @param Request $request
     * @param Order $order
     * @return 
     */
    public function processOrderPayment(Order $order)
    {
    }

    /**
     * Process a payment for a subscription.
     *
     * @param Request $request
     * @param Subscription $subscription
     * @return 
     */
    public function processSubscriptionPayment(Request $request, Subscription $subscription)
    {
    }
}
