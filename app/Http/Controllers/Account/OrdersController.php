<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class OrdersController extends Controller
{

    use AuthorizesRequests;

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

        $this->authorize('view', $order);
        
        if($order->isPaid()) {
            abort(404);
        }

        return view('pages.account.orders.pay', compact('order'));
    }
}
