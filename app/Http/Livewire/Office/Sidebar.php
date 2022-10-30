<?php

namespace App\Http\Livewire\Office;

use Illuminate\Support\Facades\Route;
use Livewire\Component;

class Sidebar extends Component
{

    public function render()
    {

        $sidebarLinks = [
            [
                'label' => 'لوحة التحكم',
                'routeName' => 'office.overview'
            ],
            // [
                // 'label' => 'الطلبات',
                // 'routeName' => 'office.orders.index'
            // ],
            [
                'label' => 'الموظفين',
                'routeName' => 'office.employees.index'
            ],
            [
                'label' => 'الرسائل',
                'routeName' => 'office.messages.index'
            ],
            [
                'label' => 'إعدادات المكتب',
                'routeName' => 'office.settings'
            ],
            [
                'label' => 'ارسال دعوة',
                'routeName' => 'office.invite'
            ],
        ];

        return view('livewire.office.sidebar', [
            'sidebarLinks' => $sidebarLinks,
            'officeId' => Route::current()->parameter('digitalOffice')
        ]);
    }
}
