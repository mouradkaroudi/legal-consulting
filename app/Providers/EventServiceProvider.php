<?php

namespace App\Providers;

use App\Events\Account\DepositAdded;
use App\Events\Account\TransactionProcessed;
use App\Events\Office\InviteSent;
use App\Events\TransactionCompleted;
use App\Listeners\Account\Orders as AccountOrdersListeners;
use App\Listeners\Account\SaveTransaction;
use App\Listeners\Account\updateAccountBalance;
use App\Listeners\SendInvitationNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        TransactionProcessed::class => [
            updateAccountBalance::class,
            AccountOrdersListeners\updateStatus::class
        ],
        InviteSent::class => [
            SendInvitationNotification::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
