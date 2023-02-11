<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class CreditController extends Controller
{
    public function index() {

        return view('pages.account.credit.index');
    }

    public function receipt( Request $request, Transaction $txn ) {
        return view('pages.account.credit.receipt', compact('txn'));
    }

}
