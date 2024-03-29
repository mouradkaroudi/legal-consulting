<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\DigitalOffice;
use App\Models\DigitalOfficeEmployee;
use App\Models\Order;
use App\Models\Thread;
use App\Policies\DigitalOfficeEmployeePolicy;
use App\Policies\DigitalOfficePolicy;
use App\Policies\OrderPolicy;
use App\Policies\ThreadPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        DigitalOffice::class => DigitalOfficePolicy::class,
        Thread::class => ThreadPolicy::class,
        Order::class => OrderPolicy::class,
        DigitalOfficeEmployee::class => DigitalOfficeEmployeePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
