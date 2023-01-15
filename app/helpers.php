<?php

use App\Models\DigitalOffice;
use App\Models\DigitalOfficeEmployee;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;

/**
 * 
 * 
 * @return string
 */
function get_option( $name ) {
    $opt = Setting::option($name)->first();
    return  $opt ? $opt->value : null;
}