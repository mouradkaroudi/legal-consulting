<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use App\Models\Thread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessagesController extends Controller
{
  /**
   * Create the controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->authorizeResource(Thread::class, "thread");
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    return view("pages.office.messages.index", [
      "officeId" => auth()->user()->currentOffice->id,
    ]);
  }

  public function show(Thread $thread)
  {

    $user = auth()->user();
    $thread->markAsRead($user->id);

    return view("pages.office.messages.show", [
      "thread" => $thread,
      "showCreateOffer" => $user->can('create', \App\Models\Order::class)
    ]);
  }
}
