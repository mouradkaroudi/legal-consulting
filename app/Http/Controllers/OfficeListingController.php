<?php

namespace App\Http\Controllers;

use App\Models\DigitalOffice;
use Illuminate\Http\Request;

class OfficeListingController extends Controller
{
    public function index()
    {
        $offices = DigitalOffice::all();
        return view('office.listing', ['offices' => $offices]);
    }

    public function show( DigitalOffice $office ) {
        return view('office.single', ['office' => $office]);
    }

}
