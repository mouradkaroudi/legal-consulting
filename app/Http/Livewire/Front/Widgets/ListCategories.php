<?php

namespace App\Http\Livewire\Front\Widgets;

use App\Models\Service;
use Livewire\Component;

class ListCategories extends Component
{
    public function render()
    {

        $services = Service::available()->limit(6)->get();

        return view('livewire.front.widgets.list-categories', ['services' => $services]);
    }
}
