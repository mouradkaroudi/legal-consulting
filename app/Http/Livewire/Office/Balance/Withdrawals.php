<?php

namespace App\Http\Livewire\Office\Balance;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Livewire\Component;

class Withdrawals extends Component implements HasForms
{

    use InteractsWithForms;

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('amount')->type('number')->required()
        ];
    }

    public function render()
    {
        return view('livewire.office.balance.withdrawals');
    }

    public function submit() {
        
    }

}
