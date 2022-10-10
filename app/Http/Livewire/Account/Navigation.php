<?php

namespace App\Http\Livewire\Account;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Navigation extends Component
{
    public $show_office_link = false;
    
    public function __construct()
    {
        $user = Auth::user();
        $this->show_office_link = !empty($user->office);
    }

    private $navigationLinks = [
        [
            'label' => 'الرئيسية',
            'link' => '/account'
        ],
        [
            'label' => 'المواعيد',
            'link' => '#'
        ],
        [
            'label' => 'الطلبات',
            'link' => '/account/orders'
        ],
        [
            'label' => 'الحساب',
            'link' => '/account/profile'
        ],
        [
            'label' => 'الرصيد',
            'link' => '/account/balance'
        ],
    ];

    public function render()
    {
        return view('livewire.account.navigation', ['navigationLinks' => $this->navigationLinks]);
    }
}
