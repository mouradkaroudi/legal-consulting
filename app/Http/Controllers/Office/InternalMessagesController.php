<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use App\Models\Thread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InternalMessagesController extends Controller
{
  /**
   * Create the controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->authorizeResource(Thread::class, "internal_thread");
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    return view("pages.office.internal-messages.index", [
      "officeId" => auth()->user()->currentOffice->id,
    ]);
  }

  public function show(Thread $internalThread)
  {
    $user = auth()->user();
    $internalThread->markAsRead($user->officeEmployment($user->currentOffice));

    return view("pages.office.internal-messages.show", [
      "thread" => $internalThread,
      "showCreateOffer" => $user->can('create', \App\Models\Order::class)
    ]);
  }
}
