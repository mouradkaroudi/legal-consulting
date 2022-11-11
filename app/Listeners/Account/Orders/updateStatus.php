<?php

namespace App\Listeners\Account\Orders;

use App\Events\Account\TransactionProcessed;
use App\Models\Order;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class OrderEventSubscriber
{
    /**
     * Handle user login events.
     */
    public function handleTransctionProcessed($event) {}
 
    /**
     * Handle user logout events.
     */
    public function handleUserLogout($event) {}
 
    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     * @return void
     */
    public function subscribe($events)
    {
        $events->listen(
            TransactionProcessed::class,
            [OrderEventSubscriber::class, 'handleUserLogin']
        );

    }
}
