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
        if(!empty($user->offices->toArray())) {
            $this->show_office_link = true;
            $this->officeId = $user->offices[0]->id;
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
                'label' => 'الحساب',
                'routeName' => 'account.profile'
            ],
            [
                'label' => 'الرصيد',
                'routeName' => 'account.balance'
            ],
        ];

        return view('livewire.account.navigation', [
            'officeId' => $this->officeId,
            'navigationLinks' => $navigationLinks
        ]);
    }
}
