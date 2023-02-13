<?php

namespace App\Http\Livewire\Payment;

use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Livewire\Component;

class Credit extends Component implements HasForms
{
    use InteractsWithForms;

    protected function getFormSchema(): array
    {
        return [
            Select::make('account')
                ->options([
                    'account' => __('Account balance'),
                    'office' => __('Office balance')
                ])
        ];
    }

    public function render()
    {
        return view('livewire.payment.credit');
    }
}
