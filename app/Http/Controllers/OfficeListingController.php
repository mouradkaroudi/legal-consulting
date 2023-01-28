<?php

namespace App\Http\Controllers;

use App\Models\DigitalOffice;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OfficeListingController extends Controller
{
    public function index(Request $request)
    {
        $offices = DigitalOffice::all();
        return view('pages.search.index', [
            'offices' => $offices,
            'service' => Service::where('slug', request('service'))->first() 
        ]);
    }

    public function show( DigitalOffice $digitalOffice ) {

        if(!$digitalOffice->isSetuped()) {
            return abort(404);
        }

        if( get_option('digital_office_hide_unsubscribed_offices') && $digitalOffice->isSubscribed() === false ) {
            return abort(404);
        }

        $displayMessagingForm = true;
        $user = auth()->user();
        if($user && $user->belongsToOffice($digitalOffice)) {
            $displayMessagingForm = false;
        }

        $orders = $digitalOffice->orders;

        return view('pages.search.single.index', [
            'office' => $digitalOffice,
            'displayMessagingForm' => $displayMessagingForm,
            'orders' => $orders
        ]);
    }

}
