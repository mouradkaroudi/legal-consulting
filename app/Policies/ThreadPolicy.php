<?php

namespace App\Policies;

use App\Models\DigitalOffice;
use App\Models\DigitalOfficeEmployee;
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

        $isEmployeeThread = $thread->sender instanceof DigitalOfficeEmployee && $thread->receiver instanceof DigitalOfficeEmployee;

        if($isEmployeeThread) {
            if(!$user->currentOffice) {
                return false;
            }

            $employee = $user->officeEmployee($user->currentOffice);

            return $thread->sender->id == $employee->id || $thread->receiver->id == $employee->id;

        }

        if ($thread->sender->id == $user->id) {
            return true;
        }

        if ($thread->receiver instanceof DigitalOffice) {
            return $user->hasOfficePermission(DigitalOffice::find($thread->receiver->id), 'manage-messages');
        }

        return $thread->sender->id == $user->id || $thread->receiver->id == $user->id;
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
        return $user->belongsToOffice($office) == false && $office->canAcceptNewMessage();
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
        if ($thread->sender->id == $user->id) {
            return true;
        }

        if ($thread->receiver instanceof DigitalOffice) {
            return $user->hasOfficePermission(DigitalOffice::find($thread->receiver->id), 'manage-messages');
        }

        return $thread->sender->id == $user->id || $thread->receiver->id == $user->id;
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
        if ($thread->sender->id == $user->id) {
            return true;
        }

        if ($thread->receiver instanceof DigitalOffice) {
            return $user->hasOfficePermission(DigitalOffice::find($thread->receiver->id), 'manage-messages');
        }

        return $thread->sender->id == $user->id || $thread->receiver->id == $user->id;
    }
}
