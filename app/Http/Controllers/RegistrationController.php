<?php

namespace App\Http\Controllers;

use App\Models\DigitalOffice;
use App\Models\DigitalOfficeEmployee;
use App\Models\Invite;
use App\Models\Setting;
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
    public function create( Request $request ) {

        $isRegistrationOpen = filter_var(get_option('registration_open'), FILTER_VALIDATE_BOOLEAN);
        
        if(!$isRegistrationOpen) {
            return abort(404);
        }

        $invite_token = $request->input('invite_token');

        $invite = Invite::where('token', $invite_token)->first();

        $office = null;

        if($invite) {
            $office = DigitalOffice::find($invite->office_id);
        }

        return view('pages.auth.registration', [
            'invite' => $invite,
            'office' => $office
        ]);
    }

}
