<?php

namespace App\Listeners;

use App\Models\User;
use App\Notifications\InvitationRequestNotification;
use Illuminate\Support\Facades\Notification;

class SendInvitationNotification
{
  /**
   * Create the event listener.
   *
   * @return void
   */
  public function __construct()
  {
    //
  }

  /**
   * Handle the event.
   *
   * @param  object  $event
   * @return void
   */
  public function handle($event)
  {

    $user = User::where('email', $event->invite->email)->get();

    Notification::send($user, new InvitationRequestNotification($event->invite));
  }
}
