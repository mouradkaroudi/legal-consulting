<?php

namespace App\Http\Livewire\Account;

use Livewire\Component;
use Filament\Forms;
use Filament\Forms\Components\Grid;

class Profile extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    protected function getFormSchema(): array
    {
        return [
            Grid::make(2)->schema([
                Forms\Components\TextInput::make('name')
                    ->label('الإسم')
                    ->required(),
                Forms\Components\TextInput::make('email')
                    ->label('البريد الإلكتروني')
                    ->required(),
            ]),
            Grid::make(2)->schema([
                Forms\Components\FileUpload::make('image')
                    ->label('الصورة الشخصية')
                ,
            ]),
        ];
    }

    public function render()
    {
        return view('livewire.account.profile');
    }
}
