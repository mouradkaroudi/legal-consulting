<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\DigitalOffice;
use Illuminate\Http\Request;

class OfficeListingController extends Controller
{
    public function index()
    {
        $offices = DigitalOffice::all();
        return view('pages.search.index', ['offices' => $offices]);
    }

    public function show( $cateogry, DigitalOffice $digitalOffice ) {

        $displayMessagingForm = true;

        return view('pages.search.single', [
            'office' => $digitalOffice,
            'displayMessagingForm' => $displayMessagingForm
        ]);
    }

}
