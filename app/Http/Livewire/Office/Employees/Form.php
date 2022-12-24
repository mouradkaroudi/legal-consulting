<?php

namespace App\Http\Livewire\Office\Employees;

use App\Models\DigitalOfficeEmployee;
use App\Models\User;
use Filament\Forms\Components\MultiSelect;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Form extends Component implements HasForms
{

    use InteractsWithForms;
    public DigitalOfficeEmployee $digitalOfficeEmployee;

    public function mount($digitalOfficeEmployee) {


        $this->form->fill([
            'name' => $digitalOfficeEmployee->user->name,
            'email' => $digitalOfficeEmployee->user->email,
            //'permissions' => $permissions
        ]);
    }

    public function submit() {
        $data = $this->form->getState();
    }

    protected function getFormSchema(): array
    {

        $permissions = Role::findByName('OfficeEmployee')->permissions->pluck('name', 'id')->toArray();

        return [
            TextInput::make('name')->label('الإسم')->disabled(),
            TextInput::make('email')->label('البريد الإلكتروني')->disabled(),
            TextInput::make('job_title')->label('المسمى الوظيفي'),
            Select::make('role_permissions')->multiple()->preload()->label('الصلاحيات')->relationship('permissions', 'name')
        ];
    }
    protected function getFormModel(): string 
    {
        return DigitalOfficeEmployee::class;
    } 

    public function render()
    {
        return view('livewire.office.employees.form');
    }
}
