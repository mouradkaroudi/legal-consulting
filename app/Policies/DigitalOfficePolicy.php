<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\DigitalOffice;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DigitalOfficePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User|Admin $user)
    {

        if($user instanceof Admin) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\DigitalOffice  $digitalOffice
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User|Admin $user, DigitalOffice $digitalOffice)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User|Admin $user)
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\DigitalOffice  $digitalOffice
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User|Admin $user, DigitalOffice $digitalOffice)
    {
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\DigitalOffice  $digitalOffice
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User|Admin $user, DigitalOffice $digitalOffice)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\DigitalOffice  $digitalOffice
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User|Admin $user, DigitalOffice $digitalOffice)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\DigitalOffice  $digitalOffice
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User|Admin $user, DigitalOffice $digitalOffice)
    {
        return false;
    }
}
