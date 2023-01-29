<?php

namespace App\Http\Livewire\Shared\Widgets;

use Livewire\Component;

class Footer extends Component
{

    public $socialLinks;

    public function mount() {

        $this->socialLinks = json_decode(setting('social_links')); 

    }

    public function render()
    {
        return view('livewire.shared.widgets.footer');
    }
}
