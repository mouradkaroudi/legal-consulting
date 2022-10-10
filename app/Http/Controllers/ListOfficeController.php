<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ListOfficeController extends Controller
{
    public function index() {
        return view('office');
    }
}
