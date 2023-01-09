<?php

namespace App\Services;



class WithDrawalsService
{

    public static function withdrawal( $holder, $amount, $metadata = [] ) {
        
        if($holder->available_balance < $amount) {
            return;
        }

        $holder->withdrawals()->create([
            'amount' => $amount,
            'metadata' => json_encode($metadata)
        ]);

        $holder->substractFromBalance($amount);
        
    }

}