<?php

namespace App\Http\Livewire\Office\Employees;

use App\Models\DigitalOfficeEmployee;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Date;
use Livewire\Component;
use Spatie\Permission\Models\Permission;

class Form extends Component implements HasForms
{
	use InteractsWithForms, AuthorizesRequests;

	public DigitalOfficeEmployee $digitalOfficeEmployee;

	public function mount($digitalOfficeEmployee)
	{

		dd($digitalOfficeEmployee->getDirectPermissions());
		$this->form->fill([
			"name" => $digitalOfficeEmployee->user->name,
			"email" => $digitalOfficeEmployee->user->email,
			"job_title" => $digitalOfficeEmployee->job_title,
			"created_at" => $digitalOfficeEmployee->created_at,
			"ended_at" => $digitalOfficeEmployee->ended_at,
			"permissions" => [
				'foo','bar'
			]
		]);
	}

	public function submit()
	{
		$this->authorize("update", [$this->digitalOfficeEmployee]);

        $redirect = false;

		$data = $this->form->getState();
		if (isset($data["ended_at"]) && !empty($data["ended_at"])) {
			$this->digitalOfficeEmployee->ended_at = Date::now();
            $redirect = true;
		}

		$this->digitalOfficeEmployee->job_title = $data["job_title"];

		$this->digitalOfficeEmployee->save();
        
        Notification::make()
        ->title('تم الحفظ بنجاح')
        ->success()
        ->send();
        
        if($redirect) {
            redirect()->route('office.employees.index');
        }

	}

	protected function getFormSchema(): array
	{

		$permissions = Permission::where('guard_name', 'web')->pluck('name', 'id'); 

		return [
			Grid::make([
				"default" => 2,
			])->schema([
				Card::make([
					TextInput::make("name")
						->label("الإسم")
						->disabled(),
					TextInput::make("email")
						->label("البريد الإلكتروني")
						->disabled(),
					TextInput::make("job_title")->label("المسمى الوظيفي"),
					CheckboxList::make("permissions")
						->label("الصلاحيات")
						//->relationship("roles", "name", fn($query) => $query->with('permissions'))
						->options($permissions)
						->getOptionLabelFromRecordUsing(function ($record) {
							return __("permissions." . $record->name);
						})
						->columns(2),
				])->columnSpan(1),
				Card::make([
					TextInput::make("created_at")
						->label("تاريخ بدء العمل")
						->disabled(),
					Toggle::make("ended_at")->label("إنهاء عقد العمل"),
				])->columnSpan(1),
			]),
		];
	}

	protected function getFormModel(): DigitalOfficeEmployee
	{
		return $this->digitalOfficeEmployee;
	}

	public function render()
	{
		return view("livewire.office.employees.form");
	}
}
