<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.account.orders.index');
    }

    /**
     * 
     */
    public function paid(Request $request)
    {

        $provider = new PayPal();
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);
        
        $order_id = $request['order_id'];

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {

            OrderService::orderPaid(Order::find($order_id));

            return redirect()->route('account.order.paid');

       } else {
            return redirect()->route('account.order.failed');
        }
    }

}