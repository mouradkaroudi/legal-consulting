<?php

namespace App\Http\Livewire\Shared;

use Livewire\Component;

class SiteLogo extends Component
{

    public $image;
    public $appName = '';

    public function mount() {
        $this->appName = site_name();
        $image = setting('general_settings_site_logo');

        if(!empty($image)) {
            $this->image = asset('storage/' . $image);
        }
        
    }

    public function render()
    {
        return view('livewire.shared.site-logo');
    }
}
