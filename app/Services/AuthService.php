<?php

namespace App\Services;

use App\Models\DigitalOffice;
use App\Models\DigitalOfficeEmployee;
use App\Models\Invite;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AuthService
{

    /**
     * Register new user
     */
    public static function registerUser($name, $email, $password, $inviteToken = null)
    {

        $user = User::create([
            "name" => $name,
            "email" => $email,
            "password" => Hash::make($password),
        ]);

        if (empty($inviteToken)) {

            event(new Registered($user));

            return $user;
        }

        $invite = Invite::where("token", $inviteToken)->first();
        if ($invite) {
            $employee = DigitalOfficeEmployee::create([
                "office_id" => $invite->office_id,
                "user_id" => $user->id,
            ]);

            Profile::create([
                "user_id" => $user->id,
            ]);

            $defaultRolePermissions = Role::findByName("OfficeEmployee")->permissions;
            $employee->givePermissionTo($defaultRolePermissions->pluck('name')->all());
        }

        event(new Registered($user));

        return $user;
    }

    /**
     * Register new service provider
     */
    public static function registerServiceProvider($name, $email, $password)
    {

        $user = User::create([
            "name" => $name,
            "email" => $email,
            "password" => Hash::make($password),
        ]);

        Profile::create([
            "user_id" => $user->id,
        ]);

       DigitalOffice::create([
            "user_id" => $user->id,
            "name" => "مكتب " . $user->name,
        ])->employees()->create([
            'user_id' => $user->id,
            'job_title' => __('auth.providers.default_job_title')
        ]);

        event(new Registered($user));

        return $user;
    }

    
}
