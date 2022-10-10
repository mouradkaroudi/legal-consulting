<?php

use App\Models\DigitalOffice;
use App\Models\DigitalOfficeEmployee;
use Illuminate\Support\Facades\Auth;

function get_current_office() {

    $user = Auth::user();

    if(!$user) {
        return;
    }

    $employee = DigitalOfficeEmployee::where('user_id', $user->id)->first();

    $office = DigitalOffice::where('id', $employee->office_id)->first();
    return $office->toArray();


}