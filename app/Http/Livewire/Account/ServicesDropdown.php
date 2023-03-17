<?php

namespace App\Http\Livewire\Account;

use App\Models\Service;
use Livewire\Component;

class ServicesDropdown extends Component
{
    public $navigationLinks = [];

    public function mount() {
        
        $services = Service::where('is_available', true)->get();

        foreach($services as $service) {
            $this->navigationLinks[] = [
                'routeName' => route('search.listing', ['service' => $service->slug]),
                'label' => $service->name
            ];
        }

    }

    public function render()
    {
        return view('livewire.account.services-dropdown');
    }
}
