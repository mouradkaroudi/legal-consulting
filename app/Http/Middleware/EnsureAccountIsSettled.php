<?php

namespace App\Http\Middleware;

use App\Models\DigitalOffice;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class EnsureAccountIsSettled
{
    /**
     * Ensure the account is settled for the users who owns or belong to a digital office.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();
        if (
			$user &&
			$user->profile &&
			$user->profile->status === DigitalOffice::UNCOMPLETED &&
			!in_array(Route::currentRouteName(), ["account.settings", "auth.logout"])
		) {
			return redirect()->route("account.settings");
		}

        return $next($request);
    }
}
