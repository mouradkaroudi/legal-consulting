<?php

namespace App\Http\Middleware;

use App\Models\DigitalOffice;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class EnsureOfficeIsSettled extends Middleware
{
    protected function authenticate($request, array $guards): void
    {
        $guardName = 'web';
        $guard = $this->auth->guard($guardName);

        if (!$guard->check()) {
            $this->unauthenticated($request, $guards);

            return;
        }

        $this->auth->shouldUse($guardName);
    }

    public function handle($request, Closure $next, ...$guards)
    {
        $user = $request->user();
        $currentOffice = $user->currentOffice;

        if ($currentOffice->status === DigitalOffice::UNCOMPLETED) {
            return redirect()->route('office.setup.index');
        }
        
        // FIXME: consider check the subscription rather than status
        if (
            $currentOffice->status === DigitalOffice::PENDING_PAYMENT
            ||
            (
                $currentOffice->haveSubscriptionPlan()
                &&
                $currentOffice->isSubscribed() === false
            )
        ) {
            return redirect()->route('office.subscription.index');
        }

        if ($currentOffice->status === DigitalOffice::PENDING) {
            return redirect()->route('office.setup.approval');
        }

        return $next($request);
    }

    protected function redirectTo($request): string
    {
        return route('auth.login');
    }
}
