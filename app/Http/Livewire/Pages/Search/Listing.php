<?php

namespace App\Http\Livewire\Pages\Search;

use App\Models\Profession;
use App\Models\Service;
use Livewire\Component;

class Listing extends Component
{

    public Service $service;
    public ?Profession $profession;

    public function render()
    {
        return view('livewire.pages.search.listing')->layout('layouts.guest');
    }
}
