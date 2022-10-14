<?php

namespace App\Http\Livewire\Office;

use Livewire\Component;

class Alerts extends Component
{

    public $alerts = [];

    public function render()
    {

        $office = get_current_office();

        if($office['status'] == 'uncomplete') {
            $this->alerts[] = [
                'message' => 'المرجو اكمال ملأ بيانات المكتب و بياناتك من اجل الظهور في الموقع',
                'status' => 'warning'
            ];
        }

        return view('livewire.office.alerts', ['alerts' => $this->alerts]);
    }
}
