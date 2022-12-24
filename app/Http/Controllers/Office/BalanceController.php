<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BalanceController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        
        return view('pages.office.balance.index', [
            'office' => auth()->user()->currentOffice
        ]);
    }
}
