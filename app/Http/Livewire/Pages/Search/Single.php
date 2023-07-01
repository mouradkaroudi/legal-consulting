<?php

namespace App\Http\Livewire\Pages\Search;

use Livewire\Component;

class Single extends Component
{
    public function render()
    {
        return view('livewire.pages.search.single')->layout('layouts.guest');
    }
}
