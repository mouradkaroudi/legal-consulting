<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardHomeController extends Controller
{
    public function index() {
        return view('pages.office.index');
    }
}
