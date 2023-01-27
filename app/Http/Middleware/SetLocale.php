<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        
        $language = $request->user() ? $request->user()->preferred_lang : 'ar'; // default

        if (request('language')) {
            $language = request('language');
            session()->put('language', $language);
        } elseif (session('language')) {
            $language = session('language');
        }
        app()->setLocale($language ? $language : 'ar');

        return $next($request);
    }
}
