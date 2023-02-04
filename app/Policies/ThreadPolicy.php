<?php

namespace App\Policies;

use App\Models\DigitalOffice;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ThreadPolicy
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
        return $user->hasOfficePermission($user->currentOffice, 'manage-messages');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Thread  $thread
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Thread $thread)
    {
        //TODO: allow participante to also access message
        return $user->hasOfficePermission(DigitalOffice::find($thread->office_id), 'manage-messages' );
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\DigitalOffice  $office
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user, DigitalOffice $office)
    {
        return $user->belongsToOffice($office) == false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Thread  $thread
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Thread $thread)
    {
        return $user->id == $thread->user_id || $user->hasOfficePermission($thread->office, 'manage-messages');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Thread  $thread
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Thread $thread)
    {
        return $user->id == $thread->user_id;
    }
    
}
