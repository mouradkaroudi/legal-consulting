<?php

namespace App\Http\Livewire\Office\Invite;

use App\Events\Office\InviteSent;
use App\Models\Invite;
use App\Models\User;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Livewire\Component;
use Illuminate\Support\Str;

class SendInviteForm extends Component implements HasForms
{

    use InteractsWithForms;

    public $email;
    public $officeId;

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

        $token =  Str::random(16);

        $invite = Invite::create([
            'office_id' => $this->officeId,
            'email' => $email,
            'token' => $token
        ]);

        InviteSent::dispatch($invite);

        Notification::make() 
        ->title('تم ارسال الدعوة')
        ->success()
        ->send();

    }
}
