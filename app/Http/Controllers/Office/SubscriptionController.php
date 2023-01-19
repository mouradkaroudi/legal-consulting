<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use App\Models\DigitalOffice;
use App\Models\ProfessionSubscriptionPlan;
use App\Services\SubscriptionService;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal;

class SubscriptionController extends Controller
{


    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('pages.office.subscription.index');
    }

    /**
     * 
     */
    public function pay(ProfessionSubscriptionPlan $professionSubscriptionPlan)
    {

        return view('pages.office.subscription.pay', compact('professionSubscriptionPlan'));
    }

    /**
     * 
     */
    public function subscribe(Request $request)
    {

        //$provider = new PayPal();
        //$provider->setApiCredentials(config('paypal'));
        //$provider->getAccessToken();
        //$response = $provider->capturePaymentOrder($request['token']);

        //if (isset($response['status']) && $response['status'] == 'COMPLETED') {

            //$office = auth()->user()->currentOffice;

            //SubscriptionService::createSubscription($office, ProfessionSubscriptionPlan::find($request['plan_id']));
            
            //if(get_option('digital_office_direct_registration') == 1) {
              //  $office->status = DigitalOffice::AVAILABLE;
            //}else{
              //  $office->status = DigitalOffice::PENDING;
            //}

           // $office->save();

            //return redirect()->route('office.subscription.success');
       // } else {
            //return redirect()->route('office.subscription.failed');
        //}
    }

    public function success( Request $request )
    {
        $provider = new PayPal();
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);

        dd($response);
        return view('pages.office.subscription.success');
    }

    public function failed()
    {
        return view('pages.office.subscription.failed');
    }
}
