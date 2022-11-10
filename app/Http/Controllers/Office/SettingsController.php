<?php

namespace App\Http\Controllers\office;

use App\Http\Controllers\Controller;
use App\Models\DigitalOffice;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(DigitalOffice $digitalOffice)
    {
        return view('pages.office.settings', ['digitalOffice' => $digitalOffice]);
    }

}
