<?php

namespace App\Listeners\Account;

use App\Events\DepositAdded;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SaveTransaction
{

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\DepositAdded  $event
     * @return void
     */
    public function handle(DepositAdded $event)
    {
        //
    }
}
