<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class DigitalOffice extends Middleware
{
    protected function authenticate($request, array $guards): void
    {
        $guardName = config('filament.auth.guard');
        $guard = $this->auth->guard($guardName);

        if (!$guard->check()) {
            $this->unauthenticated($request, $guards);

            return;
        }

        $this->auth->shouldUse($guardName);

        $user = $guard->user();

        if($user->is_admin) {
            abort(403);
        }

    }

    protected function redirectTo($request): string
    {
        return route('login');
    }
}
