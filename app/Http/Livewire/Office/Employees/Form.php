<?php

namespace App\Http\Livewire\Office\Employees;

use App\Models\DigitalOffice;
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
            'name' => $digitalOfficeEmployee->name,
        ]);
    }

    private function save( $office_id, $data ) {

    }

    public function submit() {
        $data = $this->form->getState();
        print_r($data);
        $this->digitalOfficeEmployee->assignRole($data['role']);
    }

    protected function getFormSchema(): array
    {

        $rolesArray = Role::all()->toArray();

        foreach( $rolesArray as $role ) {
            $roles[$role['name']] = $role['name'];
        }

        return [
            TextInput::make('role_name')->label('المسمى الوظيفي'),
            Select::make('role')->label('الوظيفة')->options($roles)
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
