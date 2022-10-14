<?php

namespace App\Http\Livewire\Front;

use App\Models\Category;
use Livewire\Component;
use RyanChandler\FilamentNavigation\Facades\FilamentNavigation;

class Navigation extends Component
{

    public function render()
    {
        $menu = FilamentNavigation::get('home-menu');
        
        return view('livewire.front.navigation', ['menu' => $menu]);
    }
}
