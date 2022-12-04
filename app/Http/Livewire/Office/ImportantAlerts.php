<?php

namespace App\Http\Livewire\Office;

use App\Models\DigitalOffice;
use Livewire\Component;

class ImportantAlerts extends Component
{

    public $digitalOffice;
    public $profile;
    public $uncompletedStatusAlert = false;
    public $uncompletedProfile = false;


    public function mount() {

        $user = auth()->user();
        $this->profile = $user->profile;
        $this->digitalOffice = $user->currentOffice;

        if($this->digitalOffice->status == 'uncomplete') {
            $this->uncompletedStatusAlert = true;
        }

        if( $this->profile->status === 'uncomplete' ) {
            $this->uncompletedProfile = true;
        }

    }

    public function render()
    {
        return view('livewire.office.important-alerts');
    }
}
