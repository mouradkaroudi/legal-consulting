<?php

namespace App\Http\Livewire\Office;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class Sidebar extends Component
{
  /**
   *
   */
  public $sidebarLinks = [
    [
      "label" => "لوحة التحكم",
      "routeName" => "office.overview",
    ],
  ];

  /**
   *
   */
  public function mount()
  {
    $this->fillMenu();
  }

  /**
   *
   */
  public function render()
  {
    return view("livewire.office.sidebar", [
      "officeId" => Route::current()->parameter("digitalOffice"),
    ]);
  }

  /**
   *
   */
  private function fillMenu()
  {
    $user = auth()->user();

    if (
      $user->hasOfficePermission($user->currentOffice(), "manage-employees")
    ) {
      $this->sidebarLinks[] = [
        "label" => "الموظفين",
        "routeName" => "office.employees.index",
      ];
    }

    $this->sidebarLinks[] = [
      "label" => "الطلبات",
      "routeName" => "office.orders.index",
    ];

    if ($user->hasOfficePermission($user->currentOffice(), "manage-messages")) {
      $this->sidebarLinks[] = [
        "label" => "المحادثات",
        "routeName" => "office.threads.index",
      ];
    }
    if ($user->hasOfficePermission($user->currentOffice(), "manage-office")) {
      $this->sidebarLinks[] = [
        "label" => "إعدادات المكتب",
        "routeName" => "office.settings",
      ];
    }
    if ($user->hasOfficePermission($user->currentOffice(), "send-invites")) {
      $this->sidebarLinks[] = [
        "label" => "ارسال دعوة",
        "routeName" => "office.invite",
      ];
    }
  }
}
