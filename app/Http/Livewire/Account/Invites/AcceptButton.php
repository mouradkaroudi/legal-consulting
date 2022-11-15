<?php

namespace App\Http\Livewire\Account\Invites;

use App\Models\DigitalOfficeEmployee;
use App\Models\Invite;
use App\Models\Profile;
use Livewire\Component;

class AcceptButton extends Component
{

    public $inviteToken = null;

    public function mount() {

    }

    public function accept() {
        
        $user = auth()->user();

        $invite = Invite::where('token', $this->inviteToken)->first();

        $employee = DigitalOfficeEmployee::create([
            'office_id' => $invite->office_id,
            'user_id' => $user->id
        ]);

        $employee->assignRole('OfficeEmployee');

        if(empty($user->profile)) {
            Profile::create([
                'user_id' => $user->id
            ]);
        }

    }

    public function render()
    {
        return view('livewire.account.invites.accept-button');
    }
}
