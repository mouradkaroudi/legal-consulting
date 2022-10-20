<?php

namespace App\Http\Livewire\Office\Invite;

use App\Models\Invite;
use App\Models\User;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Livewire\Component;
use Illuminate\Support\Str;

class SendInviteForm extends Component implements HasForms
{

    use InteractsWithForms;

    public $email;

    public function submit() {
        $this->createInvite($this->email);
    }

    public function render()
    {
        return view('livewire.office.invite.send-invite-form');
    }

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('email')->label(__('validation.attributes.email'))->email()
        ];
    }

    private function createInvite( $email ) {

        $token =  Str::random(16);;

        Invite::create([
            'email' => $email,
            'token' => $token
        ]);
    }
}
