<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $hasProfile = !empty($user->profile);

        return view('pages.account.settings', [
            'user' => $user,
            'hasProfile' => $hasProfile,
            'profile' => $user->profile
        ]);
    }

}
