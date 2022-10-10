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
        return view('registration');
    }

    /**
     * 
     */
    public function store( Request $request ) {

        $validated = $request->validate([
            'account_type' => 'required',
            'name' => 'required',
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:8'],
            'confirm_password' => ['same:password']
        ]);

        $account_type = $validated['account_type'];
        $name = $validated['name'];
        $email = $validated['email'];
        $password = $validated['password'];

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password)
        ]);

        if($account_type === 'provider') {

            $officeOwnerRole = Role::findByName('OfficeOwner');
            $user_id = $user->id;
            $user->assignRole($officeOwnerRole);

            $digitalOffice = DigitalOffice::create([
                'name' => ''
            ]);

            DigitalOfficeEmployee::create([
                'user_id' => $user_id,
                'office_id' => $digitalOffice->id,
                'role_name' => 'مدير'
            ]);

            Auth::loginUsingId($user->id);

            route('filament-digital-office.pages.dashboard');

        }

    }

}
