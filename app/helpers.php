<?php

use App\Models\DigitalOffice;
use App\Models\DigitalOfficeEmployee;
use Illuminate\Support\Facades\Auth;

/**
 * 
 * 
 * @return int|null
 */
function get_current_office_id() {

    $user = Auth::user();

    if(!$user) {
        return;
    }

    var_dump(request()->input('officeId'));


}