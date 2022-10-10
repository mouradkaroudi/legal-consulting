<?php

namespace App\Http\Livewire\Account;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Livewire\Component;

class RequestWithdrawalForm extends Component implements HasForms
{

    use InteractsWithForms;

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('amount')
                ->label('المبلغ')
                ->helperText('أدخل المبلغ الذي تريد سحبه')
        ];
    }

    public function render()
    {
        return view('livewire.account.request-withdrawal-form');
    }
}
