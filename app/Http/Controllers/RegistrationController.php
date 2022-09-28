<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
            
        }

    }

}
