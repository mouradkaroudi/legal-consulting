<?php

namespace App\Http\Livewire\Shared;

use Livewire\Component;

class Button extends Component
{  

    public $kind = 'primary';
    public $isLoading = false;
    public $isDisabeld = false;

    public function render()
    {

        return view(
            'livewire.shared.button',
            [
                'kind' => $this->kind,
                'isLoading' => $this->isLoading,
                'isDisabeld' => $this->isDisabeld
            ]
        );
    }
}
