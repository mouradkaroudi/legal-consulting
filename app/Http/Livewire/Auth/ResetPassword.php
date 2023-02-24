<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Livewire\Component;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;

class ResetPassword extends Component implements HasForms
{

    use InteractsWithForms;

    public $token;
    public $email;
    public $password;
    public $password_confirmation;

    public function mount() {
        $this->form->fill([
            'email' => $this->email,
            'token' => $this->token
        ]);
    }

    protected function getFormSchema(): array
    {
        return [
            Hidden::make('token'),
            Hidden::make('email'),
            TextInput::make('password')->password()->label(__('validation.attributes.password'))->confirmed()->required(),
            TextInput::make('password_confirmation')->password()->label(__('validation.attributes.password_confirmation'))->required(),
        ];
    }

    public function submit() {
        
        $this->validate();

        $status = Password::reset(
            [
                'password' => $this->password, 
                'password_confirmation' => $this->password_confirmation, 
                'token' => $this->token,
                'email' => $this->email,
        ],
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
     
                $user->save();
     
                event(new PasswordReset($user));
            }
        );
        
        if($status === Password::PASSWORD_RESET) {
            redirect()->route('auth.login')->with('status', __($status));
        }else{
            $this->addError('password', __($status));
        }
    
    }

    public function render()
    {
        return view('livewire.auth.reset-password');
    }
}
