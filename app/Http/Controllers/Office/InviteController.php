<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;

class InviteController extends Controller
{
  public function invite()
  {
    return view("pages.office.invite.index", [
      "office" => auth()->user()->currentOffice,
    ]);
  }

  public function accept($token)
  {
    return view("pages.invitation.accept");
  }
}
