<?php

namespace App\Http\Livewire\Office\Employees;

use App\Models\DigitalOffice;
use App\Models\DigitalOfficeEmployee;
use App\Services\InviteService;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Livewire\Component;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class ListEmployees extends Component implements Tables\Contracts\HasTable
{
	use Tables\Concerns\InteractsWithTable;

	public $officeId = 0;

	protected function getTableQuery(): Builder
	{
		return DigitalOfficeEmployee::query()
			->where("office_id", $this->officeId)
			->with("user");
	}

	protected function getTableHeaderActions(): array
	{
		return [
			Action::make('sendInvite')->button()
				->label(__('Send invite'))
				->action(function ($record, array $data) {
					try {
						InviteService::send(DigitalOffice::find($this->officeId), $data['email']);
						Notification::make()
							->title(__('The invitation has been sent'))
							->success()
							->send();
					} catch (\Throwable $th) {
						Notification::make()
							->title($th->getMessage())
							->danger()
							->send();
					}
				})
				->modalWidth('sm')
				->form(function () {
					return [
						TextInput::make('email')->label(__('validation.attributes.email'))->email()
					];
				})
		];
	}



	protected function getTableActions(): array
	{
		return [
			Tables\Actions\EditAction::make()
				->url(
					fn (DigitalOfficeEmployee $record): string => route(
						"office.employees.edit",
						["employee" => $record->id]
					)
				)
				->visible(fn (DigitalOfficeEmployee $record): bool => auth()->user()->can('update', $record)),
		];
	}

	protected function getTableFilters(): array
	{
		return [
			Filter::make("show_active_employees")
				->label(__('Show only active ones'))
				->query(
					fn (Builder $query, array $data): Builder => $query->active()
				),
		];
	}

	protected function getTableColumns(): array
	{
		return [
			Tables\Columns\TextColumn::make("user.name")
				->label(__("Name")),

			Tables\Columns\TextColumn::make("job_title")
				->label(__("Job title")),

			Tables\Columns\TextColumn::make("created_at")
				->label(__("Start work date"))
				->date(),

			Tables\Columns\TextColumn::make("ended_at")
				->label(__("Departure Date"))
				->date(),
		];
	}

	public function render()
	{
		return view("livewire.office.employees.list-employees");
	}
}
