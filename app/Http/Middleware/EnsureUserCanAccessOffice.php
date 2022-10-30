<?php

namespace App\Http\Middleware;

use App\Models\DigitalOffice;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureUserCanAccessOffice
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {   
        $user = $request->user();
        if(!$user) {
            return redirect('login');
        }
        
        $office = $request->route()->parameters()['digitalOffice'];

        if(!$office instanceof DigitalOffice) {
            $office = DigitalOffice::find($office);
        }

        if(!$user->belongsToOffice($office)) {
            abort(404);
        }

        return $next($request);
    }
}
