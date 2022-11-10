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

    public $permissions;

    public function mount($digitalOfficeEmployee) {

        $permissions = [];

        foreach( $digitalOfficeEmployee->getAllPermissions() as $permission ) {
            $permissions[$permission['name']] = $permission['name'];
        }

        $this->form->fill([
            'name' => $digitalOfficeEmployee->user->name,
            'email' => $digitalOfficeEmployee->user->email,
            'permissions' => $permissions
        ]);
    }

    public function submit() {
        $data = $this->form->getState();   
    }

    protected function getFormSchema(): array
    {

        $permissionsArray = Role::findByName('OfficeEmployee')->permissions->toArray();
        $permissions = [];

        foreach( $permissionsArray as $permission ) {
            $permissions[$permission['name']] = $permission['name'];
        }

        return [
            TextInput::make('name')->label('الإسم')->disabled(),
            TextInput::make('email')->label('البريد الإلكتروني')->disabled(),
            TextInput::make('role_name')->label('المسمى الوظيفي'),
            Select::make('permissions')->multiple()->label('الصلاحيات')->options($permissions)
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
