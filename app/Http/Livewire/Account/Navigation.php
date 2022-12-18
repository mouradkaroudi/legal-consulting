<?php

namespace App\Http\Livewire\Account;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Navigation extends Component
{
    public $show_office_link = false;
    public $officeId = null;
    public $navigationLinks;

    public function __construct()
    {
        $user = Auth::user();
        $offices = $user->allOffices()->toArray();
        if(!empty(($offices))) {
            $this->show_office_link = true;
            $this->officeId = $offices[0]['id'];
        }

        $this->navigationLinks = [
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

        ];

        if($user->profile) {
            $this->navigationLinks[] = [
                'label' => 'المكاتب',
                'routeName' => 'account.offices'
            ];
            $this->navigationLinks[] = [
                'label' => 'الدعوات',
                'routeName' => 'account.invites'
            ];
        }

    }

    public function render()
    {
        return view('livewire.account.navigation', [
            'officeId' => $this->officeId
        ]);
    }
}
