<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use App\Models\DigitalOffice;
use App\Models\ProfessionSubscriptionPlan;
use App\Models\Transaction;
use App\Services\SubscriptionService;
use App\Services\TransactionService;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, ProfessionSubscriptionPlan $professionSubscriptionPlan)
    {
        return view('pages.office.subscription.index', [
            'plan' => $professionSubscriptionPlan
        ]);
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function select(Request $request)
    {
        $plans = ProfessionSubscriptionPlan::where('profession_id', $request->user()->currentOffice->profession_id)->get();

        return view('pages.office.subscription.select', [
            'plans' => $plans ?? []
        ]);
    }


    /**
     * Handle subscribe to a profession plan request.
     */
    public function subscribe(Request $request, ProfessionSubscriptionPlan $professionSubscriptionPlan)
    {
        

    }
}
