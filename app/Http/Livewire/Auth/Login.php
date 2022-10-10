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
            TextInput::make('email')->required(),
            TextInput::make('password')->password()->required()
        ];
    }

    public function save() {

    }

    public function submit() {
        $data = $this->form->getState();

        if(! Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
            throw ValidationException::withMessages([
                'email' => 'البريد الإلكتروني أو كلمة السر خطأ',
            ]);
        }

        return redirect()->intended('account');

    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
