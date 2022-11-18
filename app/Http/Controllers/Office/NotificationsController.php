<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    
    public function __invoke()
    {
        $user = auth()->user();
        $notifications = $user->currentOffice()->notifications;
        $user->currentOffice()->unreadNotifications->markAsRead();

        return view('pages.office.notifications.index', compact('notifications'));
    }

}
