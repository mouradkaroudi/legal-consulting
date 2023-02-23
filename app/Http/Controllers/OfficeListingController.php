<?php

namespace App\Http\Controllers;

use App\Models\DigitalOffice;
use App\Models\Profession;
use App\Models\Service;
use Illuminate\Http\Request;

class OfficeListingController extends Controller
{
    public function index(Request $request, Service $service, ?Profession $profession = null)
    {

        if (!$service->is_available) {
            abort(404);
        }

        if ($profession && !$profession->is_available) {
            abort(404);
        }

        return view('pages.search.index', [
            'service' => $service,
            'profession' => $profession
        ]);
    }

    /**
     * 
     */
    public function show(Service $service, ?Profession $profession, DigitalOffice $digitalOffice)
    {

        if (!$service->is_available || !$profession->is_available) {
            abort(404);
        }

        if (!$digitalOffice->isSetuped()) {
            return abort(404);
        }

        if (setting('digital_office_hide_unsubscribed_offices') == 1 && $digitalOffice->isSubscribed() === false) {
            return abort(404);
        }

        $displayMessagingForm = true;
        $user = auth()->user();
        
        if (!$digitalOffice->canAcceptNewMessage() || ($user && $user->belongsToOffice($digitalOffice))) {
            $displayMessagingForm = false;
        }

        $orders = $digitalOffice->orders()->whereHas('reviews')->get();
  
        return view('pages.search.single.index', [
            'office' => $digitalOffice,
            'displayMessagingForm' => $displayMessagingForm,
            'orders' => $orders
        ]);
    }
}
