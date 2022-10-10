<?php

namespace App\Http\Livewire;

use App\Models\DigitalOffice;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Yemenpoint\FilamentGoogleMapLocationPicker\Forms\Components\LocationPicker;

class EditOfficeSettings extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;
    use AuthorizesRequests;

    public DigitalOffice $digitalOffice;

    public $name;
    public $phone_number;
    public $status;

    public function mount(): void
    {
        $this->digitalOffice = DigitalOffice::query()->userOffice()->first();

        $this->form->fill([
            'name' => $this->digitalOffice->name,
            'description' => $this->digitalOffice->description,
            'image' => $this->digitalOffice->image,
            'phone_number' => $this->digitalOffice->phone_number,
            'license_number' => $this->digitalOffice->license_number,
            'license_attachment' => $this->digitalOffice->license_attachment,
            'country_code' => $this->digitalOffice->country_code,
            'city' => $this->digitalOffice->city,
            'status' => $this->digitalOffice->status,
        ]);
    }

    protected function getFormSchema(): array
    {
        return [
            Grid::make(2)->schema([
                Forms\Components\TextInput::make('name')->required(),
                Forms\Components\TextInput::make('phone_number'),
            ]),
            Grid::make(2)->schema([
                Forms\Components\TextInput::make('license_number'),
                Forms\Components\FileUpload::make('license_attachment'),
            ]),
            Grid::make(2)->schema([
                Forms\Components\FileUpload::make('image'),
            ]),
            Forms\Components\MarkdownEditor::make('description'),
            Grid::make(2)->schema([
                Forms\Components\Select::make('status')->options([
                    'busy' => 'مشغول',
                    'available' => 'متوفر'
                ]),
            ]),
        ];
    }

    public function save(): void
    {
    } 

    public function submit(): void
    {
        $this->authorize('update',$this->digitalOffice);

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
        return view('livewire.edit-office-settings', ['status', $this->status]);
    }
}
