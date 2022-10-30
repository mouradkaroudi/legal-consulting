<?php

namespace App\Http\Controllers;

use App\Models\DigitalOffice;
use App\Models\DigitalOfficeEmployee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class RegistrationController extends Controller
{

    /**
     * 
     */
    public function create() {
        return view('pages.auth.registration');
    }

}
