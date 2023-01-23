<?php

namespace App\Policies;

use App\Models\Invite;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class InvitePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Invite  $invite
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Invite $invite)
    {

        if ($user->currentOffice) {
            return $user->currentOffice->id == $invite->office_id && $user->hasOfficePermission($user->currentOffice, 'send-invites');
        }

        return $user->email == $invite->email;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        if ($user->currentOffice) {
            return $user->hasOfficePermission($user->currentOffice, 'send-invites');
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Invite  $invite
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Invite $invite)
    {
        if ($user->currentOffice) {
            return $user->currentOffice->id == $invite->office_id && $user->hasOfficePermission($user->currentOffice, 'send-invites');
        }

        return $user->email == $invite->email;
    }

}
