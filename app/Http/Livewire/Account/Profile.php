<?php

namespace App\Http\Livewire\Account;

use App\Models\Country;
use App\Models\Profile as ModelsProfile;
use Filament\Forms\Components;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Livewire\Component;

class Profile extends Component implements HasForms
{

    use InteractsWithForms;

    public ModelsProfile $profile;
    
    public function mount($profile) {
        $this->form->fill($profile->toArray());
    }

    protected function getFormSchema(): array
    {

        $countries = Country::all();
        $citizenships = [];

        foreach( $countries as $country ) {
            $citizenships[$country->id] = $country->citizenship;
        }

        return [
            Components\TextInput::make('national_ID')->label('الهوية الوطنية')->required(),
            Components\TextInput::make('degree')->label('الدرجة العلمية')->required(),
            Components\Select::make('origin_country')->options($citizenships)->label('الجنسية'),
            Components\Select::make('gender')->options([
                'male' => 'ذكر',
                'female' => 'انثى'
            ])->label('الجنس')->required(),
            Components\FileUpload::make('national_id_attachment')->label('صورة الهوية'),
            Components\Select::make('status')->options([
                'available' => 'متوفر',
                'busy' => 'مشغول'
            ])->label('الحالة'),
        ];
    }

    public function render()
    {
        return view('livewire.account.profile');
    }

    public function submit() {

        $this->validate([
            'national_ID' => 'required|string|min:6',
            'degree' => 'required|string|min:6',
            'nationality' => 'required|string|min:6',
            'gender' => 'required|string|min:6',
            // 'national_id_attachment' => 'required|string|min:6',
            'status' => ['required'],
        ]);

        $data = $this->form->getState();
    }
}
