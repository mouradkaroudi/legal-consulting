<?php

namespace App\Http\Livewire\Office;

use App\Models\Order;
use Livewire\Component;

class OfficeStats extends Component
{   

    public $employees = 0;
    public $revenue = 0;
    public $orders = 0;
    public $pendingOrders = 0;

    public function mount() {

        $user =  auth()->user();

        $this->employees = $user->currentOffice->employees->count();
        $this->orders = $user->currentOffice->orders->count();
        $this->pendingOrders = $user->currentOffice->orders->where('status', Order::UNPAID)->count();
        $this->revenue = $user->currentOffice->orders->where('status', Order::PAID)->sum('amount');

    }

    public function render()
    {
        return view('livewire.office.office-stats');
    }
}
