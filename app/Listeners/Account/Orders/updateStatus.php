<?php

namespace App\Listeners\Account\Orders;

use App\Events\Account\TransactionProcessed;
use App\Models\Order;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class updateStatus
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
     * @param  object  $event
     * @return void
     */
    public function handle(TransactionProcessed $event)
    {
        $txn = $event->txn;

        if($txn->type === 'pay_dues') {
            $metadata = json_decode($txn->metadata);
            $orderId = isset($metadata['orderId']) && !empty($metadata['orderId']) ? $metadata['orderId'] : null;
            if($orderId) {
                $order = Order::find($orderId);
                $order->status = 'paid';
                $order->save();
            }
        }

    }
}
