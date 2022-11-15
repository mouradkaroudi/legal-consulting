<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InvitesController extends Controller
{
    
    public function __invoke()
    {
        return view('pages.account.invites.index');
    }

}
