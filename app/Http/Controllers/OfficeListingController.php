<?php

namespace App\Http\Controllers;

use App\Models\DigitalOffice;
use Illuminate\Http\Request;

class OfficeListingController extends Controller
{
    public function index()
    {
        $offices = DigitalOffice::all();

        return view('offices', ['offices' => $offices]);
    }

    public function show() {
        return view('office');
    }

}
