<?php

namespace App\Listeners;

use App\Mail\InviteCreated;
use App\Models\User;
use App\Notifications\InvitationRequestNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class SendInvitationNotification
{

  /**
   * Handle the event.
   *
   * @param  object  $event
   * @return void
   */
  public function handle($event)
  {

    $user = User::where('email', $event->invite->email)->get();
    if(empty($user->email)) {
      Mail::to($event->invite->email)->send(new InviteCreated($event->invite));
    }else{
      Notification::send($user, new InvitationRequestNotification($event->invite));
    }

  }
}
