<?php

namespace App\Listeners;
use Illuminate\Support\Facades\Notification;

use App\Events\Transaction as TransactionEvents;
use App\Notifications\TransactionNotification;

;

class TransactionEventSubscriber
{
    /**
     * 
     */
    public function handleTransactionAccpeted($event) {
        $this->txn = $event->txn;
        Notification::send($this->txn->transactionable, new TransactionNotification($this->txn, 'accepted'));
    }
 
    /**
     * 
     */
    public function handleTransactionRefused($event) {
        $this->txn = $event->txn;
        $this->body = $event->body;
        Notification::send($this->txn->transactionable, new TransactionNotification($this->txn, 'refused', $this->body));
    }

    /**
     * 
     */
    public function handleTransactionPending($event) {}


    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     * @return void
     */
    public function subscribe($events)
    {
        return [
            TransactionEvents\Accepted::class => 'handleTransactionAccpeted',
            TransactionEvents\Refused::class => 'handleTransactionRefused'
        ];
 
    }
}
