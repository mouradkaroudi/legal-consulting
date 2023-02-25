<?php

namespace App\Http\Livewire\Shared\Widgets;

use Livewire\Component;
use RyanChandler\FilamentNavigation\Facades\FilamentNavigation;

class Footer extends Component
{

    public $socialLinks;

    public function mount() {

        $this->socialLinks = json_decode(setting('social_links')); 
    }

    public function render()
    {
        $name = 'footer-menu-'. app()->getLocale();
        $menu = FilamentNavigation::get($name);
        
        if(empty($menu)) {
            return view('livewire.shared.widgets.footer', ['menu' => []]);
        }

        $menuItems = $menu->items;
        $menuItems = buildMenuUrl($menuItems);

        return view('livewire.shared.widgets.footer', ['menu' => $menuItems]);
    }
}
