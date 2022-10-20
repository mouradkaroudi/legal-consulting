<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InviteController extends Controller
{
  public function invite()
  {
    return view('pages.office.invite.index');
  }
  public function accept($token)
  {
    return view('pages.invitation.accept');
  }
}
