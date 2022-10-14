<?php

namespace App\Http\Livewire\Auth;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class Login extends Component implements HasForms
{
    use InteractsWithForms;

    public $email;
    public $password;

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('email')->label(__('validation.attributes.email'))->required(),
            TextInput::make('password')->label(__('validation.attributes.password'))->password()->required()
        ];
    }

    public function submit() {
        $data = $this->form->getState();

        if(! Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        return redirect()->intended('account');

    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
