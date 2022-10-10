<?php

namespace App\Http\Livewire\Account;

use Livewire\Component;

class BalanceOverview extends Component
{

    public $totalBalance;
    public $availableBalance;
    public $balanceInHold;

    public function mount()
    {
        $user = auth()->user();

        $this->totalBalance = floatval($user->hold_balance + $user->available_balance);
        $this->availableBalance = floatval($user->available_balance);
        $this->balanceInHold = floatval($user->hold_balance);
    }

    public function render()
    {
        return view('livewire.account.balance-overview');
    }
}
