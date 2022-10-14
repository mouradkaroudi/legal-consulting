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

function get_current_user_avatar() {
    
    $user = Auth::user();

    if(!$user) {
        return '';
    }

    return 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80';    
}