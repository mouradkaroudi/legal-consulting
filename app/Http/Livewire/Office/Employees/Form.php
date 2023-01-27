<?php

namespace App\Http\Livewire\Office\Employees;

use App\Models\DigitalOfficeEmployee;
use Carbon\Carbon;
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

		$formatedDate = Carbon::parse($digitalOfficeEmployee->updated_at)
			->translatedFormat(config('tables.date_format'));

		$this->form->fill([
			"name" => $digitalOfficeEmployee->user->name,
			"email" => $digitalOfficeEmployee->user->email,
			"job_title" => $digitalOfficeEmployee->job_title,
			"updated_at" => $formatedDate,
			"ended_at" => $digitalOfficeEmployee->ended_at,
			"permissions" => $digitalOfficeEmployee->getDirectPermissions()->pluck('id')->all()
		]);
	}

	public function submit()
	{
		$this->authorize("update", [$this->digitalOfficeEmployee]);

		$data = $this->form->getState();

		$permissions = $data['permissions'];

		if (isset($data["ended_at"])) {
			if (!empty($data["ended_at"])) {
				$this->digitalOfficeEmployee->ended_at = Date::now();
			} else {
				$this->digitalOfficeEmployee->ended_at = null;
			}
		}

		$this->digitalOfficeEmployee->job_title = $data["job_title"];
		$this->digitalOfficeEmployee->save();

		$this->digitalOfficeEmployee->syncPermissions($permissions);

		Notification::make()
			->title(__("The information has been updated successfully"))
			->success()
			->send();
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
						->label(__('Name'))
						->disabled(),
					TextInput::make("email")
						->label(__('Email address'))
						->disabled(),
					TextInput::make("job_title")
						->label('Job title'),
					CheckboxList::make("permissions")
						->label(__('Permissions'))
						->options($permissions)
						->columns(2),
				])->columnSpan(1),
				Card::make([
					TextInput::make("updated_at")
						->label(__('Start work date'))
						->disabled(),
					Toggle::make("ended_at")
						->label(__('Finish work contract')),
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
