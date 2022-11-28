<?php

use App\Models\DigitalOffice;
use App\Models\DigitalOfficeEmployee;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;

/**
 * 
 * 
 * @return int|null
 */
function get_option( $name ) {
    return Setting::option($name)->first()->value;
}