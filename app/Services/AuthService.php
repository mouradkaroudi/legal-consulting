<?php

namespace App\Services;

use App\Models\DigitalOffice;
use App\Models\DigitalOfficeEmployee;
use App\Models\Invite;
use App\Models\Profile;
use App\Models\User;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Throwable;

class AuthService
{

    /**
     * Register new user
     */
    public static function registerUser($name, $email, $password, $inviteToken = null)
    {

        try {
            DB::beginTransaction();

            $user = User::create([
                "name" => $name,
                "email" => $email,
                "password" => Hash::make($password),
            ]);

            if (empty($inviteToken)) {

                event(new Registered($user));
                DB::commit();
                return $user;
            }

            $invite = Invite::where("token", $inviteToken)->first();
            if ($invite) {
                $employee = DigitalOfficeEmployee::create([
                    "office_id" => $invite->office_id,
                    "user_id" => $user->id,
                ]);

                $profile = new Profile();
                $profile->user_id = $user->id;
                $profile->save();

                $defaultRolePermissions = Role::findByName("OfficeEmployee")->permissions;
                $employee->givePermissionTo($defaultRolePermissions->pluck('name')->all());

                $user->markEmailAsVerified();

                $invite->delete();

            }


            event(new Registered($user));

            DB::commit();

            return $user;
        } catch (\Throwable $th) {
            DB::rollback();
            throw new Exception($th->getMessage());
        }
    }

    /**
     * Register new service provider
     */
    public static function registerServiceProvider($name, $email, $password)
    {

        try {
            DB::beginTransaction();
            $user = User::create([
                "name" => $name,
                "email" => $email,
                "password" => Hash::make($password),
            ]);

            $profile = new Profile();

            $profile->user_id = $user->id;

            $profile->save();

            DigitalOffice::create([
                "user_id" => $user->id,
                "name" => __("Office") . ' ' . $user->name,
                "status" => DigitalOffice::UNCOMPLETED
            ])->employees()->create([
                'user_id' => $user->id,
                'job_title' => __('auth.providers.default_job_title')
            ]);
            event(new Registered($user));
            DB::commit();

            return $user;
        } catch (Throwable $e) {
            DB::rollback();
            throw new Exception($e->getMessage());
        }

        
    }
}
