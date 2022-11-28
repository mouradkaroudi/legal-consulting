<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
        
        $displayMessagingForm = true;
        $user = auth()->user();
        if($user && $user->belongsToOffice($digitalOffice)) {
            $displayMessagingForm = false;
        }

        return view('pages.search.single', [
            'office' => $digitalOffice,
            'displayMessagingForm' => $displayMessagingForm
        ]);
    }

}
