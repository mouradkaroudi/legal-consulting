<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class CreditController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('pages.office.credit.index', [
            'office' => auth()->user()->currentOffice
        ]);
    }

    public function receipt( Request $request, Transaction $txn ) {

        $office = auth()->user()->currentOffice;

        if( $txn->transactionable->id != $office->id || !$request->user()->hasOfficePermission($office, 'view-balance') ) {
            abort(404);
        }

        return view('pages.office.credit.receipt', compact('txn'));
    }

}
