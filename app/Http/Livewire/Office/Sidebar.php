<?php

namespace App\Http\Livewire\Office;

use App\Models\DigitalOfficeEmployee;
use App\Models\Message;
use App\Models\Order;
use App\Models\Thread;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class Sidebar extends Component
{
  /**
   *
   */
  public $sidebarLinks = [];

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

    $this->sidebarLinks[] =     [
      "label" => __("Dashboard"),
      "routeName" => "office.overview",
      'icon' => 'heroicon-o-home'
    ];

    $this->sidebarLinks[] = [
      "label" => __("Notifications"),
      "routeName" => "office.notifications",
      'icon' => 'heroicon-o-bell'
    ];

    $this->sidebarLinks[] = [
      "label" => __("Schedules"),
      "routeName" => "office.schedules.index",
      'icon' => 'heroicon-o-calendar'
    ];

    if (
      $user->can('viewAny', DigitalOfficeEmployee::class)
    ) {
      $this->sidebarLinks[] = [
        "label" => __("Employees"),
        "routeName" => "office.employees.index",
        'icon' => 'heroicon-o-users'
      ];
    }

    if ($user->can('viewAny', Order::class)) {
      $this->sidebarLinks[] = [
        "label" => __("Orders"),
        "routeName" => "office.orders.index",
        'icon' => 'heroicon-o-shopping-cart'
      ];
    }

    if ($user->can('viewAny', Thread::class)) {
      $this->sidebarLinks[] = [
        "label" => __("Messages"),
        "routeName" => "office.threads.index",
        'icon' => 'heroicon-o-chat-alt-2',
        'badge' => Message::unreadForUserOffice(Auth::id(), $user->currentOffice->id)->count()
      ];
    }
  }
}
