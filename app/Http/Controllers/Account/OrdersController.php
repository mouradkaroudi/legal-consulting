<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Transaction;
use App\Services\TransactionService;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('pages.account.orders.index');
    }

    /**
     * 
     */
    public function pay(Request $request, Order $order)
    {
        
        if($order->isPaid()) {
            abort(404);
        }

        return view('pages.account.orders.pay', compact('order'));
    }
}

/*
        if ($request->user()->available_balance < $amount) {
            return redirect()->route('account.orders.index')->withErrors([
                'message' => __("Insufficient account balance. Please try another payment method")
            ]);
        }

        TransactionService::pay(
            $request->user(),
            $order->office,
            $amount,
            Transaction::SUCCESS,
            ['order_id' => $order->id]
        );

        $order->markAsPaid();
*/