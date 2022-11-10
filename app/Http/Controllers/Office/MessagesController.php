<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use App\Models\DigitalOffice;
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
  public function index(Request $request, DigitalOffice $digitalOffice)
  {
    return view("pages.office.messages.index", [
      "officeId" => $digitalOffice->id,
    ]);
  }

  public function show(DigitalOffice $digitalOffice, Thread $thread)
  {

    $userId = Auth::id();
    $thread->markAsRead($userId);

    return view("pages.office.messages.show", ["thread" => $thread]);
  }
}
