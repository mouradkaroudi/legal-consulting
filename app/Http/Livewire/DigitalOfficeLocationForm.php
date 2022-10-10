<?php

namespace App\Http\Livewire;

use App\Models\DigitalOffice;
use Livewire\Component;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Yemenpoint\FilamentGoogleMapLocationPicker\Forms\Components\LocationPicker;

class DigitalOfficeLocationForm extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    public DigitalOffice $digitalOffice;

    public function mount(): void
    {
        $this->digitalOffice = DigitalOffice::query()->userOffice()->first();

        $this->form->fill([
            'country_code' => $this->digitalOffice->country_code,
            'city' => $this->digitalOffice->city,
        ]);
    }

    protected function getFormSchema(): array
    {
        return [

            Grid::make(2)->schema([
                Forms\Components\Select::make('country_code'),
                Forms\Components\Select::make('city'),
            ]),
            LocationPicker::make("location"),
        ];
    }

    public function save(): void
    {
    }

    public function submit(): void
    {
        $this->authorize('update', $this->digitalOffice);

        $this->digitalOffice->update(
            $this->form->getState(),
        );
    }

    protected function getFormModel(): DigitalOffice
    {
        return $this->digitalOffice;
    }

    public function render()
    {
        return view('livewire.digital-office-location-form');
    }
}
