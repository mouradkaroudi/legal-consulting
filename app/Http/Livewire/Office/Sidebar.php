<?php

namespace App\Http\Livewire\Office;

use App\Models\Message;
use App\Models\Thread;
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
      'icon' => 'heroicon-o-home'
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

    $this->sidebarLinks[] = [
      "label" => "التنبيهات",
      "routeName" => "office.notifications",
      'icon' => 'heroicon-o-bell'
    ];
    $this->sidebarLinks[] = [
      "label" => "جدول المواعيد",
      "routeName" => "office.schedules.index",
      'icon' => 'heroicon-o-calendar'
    ];

    if (
      $user->hasOfficePermission($user->currentOffice, "manage-employees")
    ) {
      $this->sidebarLinks[] = [
        "label" => "الموظفين",
        "routeName" => "office.employees.index",
        'icon' => 'heroicon-o-users'
      ];
    }

    $this->sidebarLinks[] = [
      "label" => "الطلبات",
      "routeName" => "office.orders.index",
      'icon' => 'heroicon-o-shopping-cart'
    ];

    if ($user->hasOfficePermission($user->currentOffice, "manage-messages")) {
      $this->sidebarLinks[] = [
        "label" => "المحادثات",
        "routeName" => "office.threads.index",
        'icon' => 'heroicon-o-chat-alt-2',
        'badge' => Message::unreadForUserOffice(Auth::id(), $user->currentOffice->id)->count()
      ];
    }

  }
}
