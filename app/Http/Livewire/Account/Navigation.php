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
                'label' => __('Home'),
                'routeName' => 'account.overview'
            ],
            [
                'label' => __('Orders'),
                'routeName' => 'account.orders.index'
            ],
            [
                'label' => __('Account'),
                'routeName' => 'account.settings'
            ],
            [
                'label' => __('Balance'),
                'routeName' => 'account.balance'
            ],

        ];

        if($user->profile) {
            $this->navigationLinks[] = [
                'label' => __('Offices'),
                'routeName' => 'account.offices'
            ];
            $this->navigationLinks[] = [
                'label' => __('Invites'),
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
