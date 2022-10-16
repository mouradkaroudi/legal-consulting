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
        return view('livewire.account.navigation', [
            'officeId' => $this->officeId,
            'navigationLinks' => $this->navigationLinks
        ]);
    }
}
