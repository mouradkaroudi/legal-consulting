<?php

namespace App\Http\Livewire\Front; // FIXME: change front to guest

use App\Models\User;
use Filament\AvatarProviders\UiAvatarsProvider;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use RyanChandler\FilamentNavigation\Facades\FilamentNavigation;

class Navigation extends Component
{
    public function render()
    {
        $menu = FilamentNavigation::get('home-menu');

        if(empty($menu)) {
            return view('livewire.front.navigation', ['menu' => []]);
        }

        $menuItems = $menu->items;

        $menuItems = buildMenuUrl($menuItems);

        return view('livewire.front.navigation', ['menu' => $menuItems]);
    }

}
