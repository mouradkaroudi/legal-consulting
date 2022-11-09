<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use App\Models\DigitalOffice;
use Illuminate\Http\Request;

class InviteController extends Controller
{
  public function invite(DigitalOffice $digitalOffice)
  {
    return view('pages.office.invite.index', [
      'office' => $digitalOffice
    ]);
  }

  public function accept($token)
  {
    return view('pages.invitation.accept');
  }
}
