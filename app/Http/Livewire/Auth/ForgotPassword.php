<?php

namespace App\Http\Livewire\Auth;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Livewire\Component;
use Illuminate\Support\Facades\Password;

class ForgotPassword extends Component implements HasForms
{

    use InteractsWithForms;

    public $email;
    
    protected function getFormSchema(): array
    {
        return [
            TextInput::make('email')->email()->label(__('validation.attributes.email'))->required(),
        ];
    }

    public function submit() {
        $this->resetErrorBag();
        $status = Password::sendResetLink(
            ['email' => $this->email]
        );
        
        if($status === Password::RESET_LINK_SENT) {
            Notification::make()
            ->body(__($status))
            ->success()
            ->send();
        }else{
            $this->addError('email', __($status));
        }
    }

    public function render()
    {
        return view('livewire.auth.forgot-password');
    }
}
