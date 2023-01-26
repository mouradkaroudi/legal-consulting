<?php

namespace App\Http\Livewire\Front; // FIXME: change front to guest

use App\Models\Category;
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

        $menuItems = $this->buildUrl($menuItems);

        return view('livewire.front.navigation', ['menu' => $menuItems]);
    }

    private function buildUrl(&$menuItems)
    {

        foreach ($menuItems as &$menuItem) {
            
            if(!isset($menuItem['data']['url']) && !empty($menuItem['type'])) {
                $menuItem['data']['url'] = $menuItem['type'] != null ? $this->generateResourceUrl($menuItem['type'], $menuItem['data']) : '#';
            }

            if (!empty($menuItem['children'])) {
                $menuItem['children'] = $this->buildUrl($menuItem['children']);
            }
        }

        return $menuItems;
    }

    private function generateResourceUrl($resourceType, $data)
    {

        if ($resourceType == 'khdm') {
            $service = \App\Models\Service::find($data['service_id']);
            return route('search.listing', ['service' => $service->slug]);
        }

        if ($resourceType == 'mhn') {
            $profession = \App\Models\Profession::find($data['profession_id']);
            return route('search.listing', ['service' => $profession->service->slug, 'profession' => $profession->slug,]);
        }

        return '';
    }
}
