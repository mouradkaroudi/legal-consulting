<?php

namespace App\Http\Livewire\Account;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Navigation extends Component
{
    public $show_office_link = false;
    public $officeId = null;

    public function __construct()
    {
        $user = Auth::user();
        $offices = $user->allOffices()->toArray();
        if(!empty(($offices))) {
            $this->show_office_link = true;
            $this->officeId = $offices[0]['id'];
        }
    }

    public function render()
    {

        $navigationLinks = [
            [
                'label' => 'الرئيسية',
                'routeName' => 'account.overview'
            ],
            [
                'label' => 'الطلبات',
                'routeName' => 'account.orders.index'
            ],
            [
                'label' => 'الحساب',
                'routeName' => 'account.settings'
            ],
            [
                'label' => 'الرصيد',
                'routeName' => 'account.balance'
            ],
            [
                'label' => 'الدعوات',
                'routeName' => 'account.invites'
            ],
        ];

        return view('livewire.account.navigation', [
            'officeId' => $this->officeId,
            'navigationLinks' => $navigationLinks
        ]);
    }
}
