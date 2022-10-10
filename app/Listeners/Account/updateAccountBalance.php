<?php

namespace App\Listeners\Account;

use App\Events\Account\TransactionProcessed;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class updateAccountBalance
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
    public function handle(TransactionProcessed $event)
    {
        $txn = $event->txn;

        if(!in_array($txn->status, ['completed', 'hold'])) {
            return;
        }

        $user_id = $txn->user_id;
        $type = $txn->type;
        $amount = $txn->amount;
        $user = User::find($user_id);
        if($txn->status === 'completed') {
            if($type === 'debit') {
                $user->available_balance += $amount;
            }else{
                $user->available_balance -= $amount;
            }
        }else{
            $user->hold_balance += $amount;
        }


        $user->save();

    }
}
