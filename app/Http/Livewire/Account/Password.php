<?php

namespace App\Http\Livewire\Account;

use Livewire\Component;
use Filament\Forms;
use Filament\Forms\Components\Grid;

class Password extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    protected function getFormSchema(): array
    {
        return [
            Grid::make(1)->schema(
                [
                    Forms\Components\TextInput::make('password')
                        ->password()
                        ->label('كلمة المرور الحالية')
                        ->required(),
                ]
            ),
            Grid::make(2)->schema(
                [
                    Forms\Components\TextInput::make('new_pwd')
                    ->password()
                    ->label('تأكيد كلمة المرور')
                    ->required(),
                    Forms\Components\TextInput::make('new_pwd')
                    ->password()
                    ->label('كلمة المرور الجديدة')
                    ->required(),
                ]
            )
        ];
    }

    public function render()
    {
        return view('livewire.account.password');
    }
}
