<?php

namespace App\Http\Livewire\Front\Widgets;

use App\Models\DigitalOffice;
use Livewire\Component;

class ListOffices extends Component
{
    public function render()
    {
        $offices = DigitalOffice::all();
        return view('livewire.front.widgets.list-offices', ['offices' => $offices]);
    }
}
