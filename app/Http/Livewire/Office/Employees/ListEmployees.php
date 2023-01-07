<?php

namespace App\Http\Livewire\Office\Employees;

use App\Models\DigitalOfficeEmployee;
use Livewire\Component;
use Filament\Tables;
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

	public function render()
	{
		return view("livewire.office.employees.list-employees");
	}

	protected function getTableActions(): array
	{
		return [
			Tables\Actions\EditAction::make()
				->url(
					fn(DigitalOfficeEmployee $record): string => route(
						"office.employees.edit",
						["employee" => $record->id]
					)
				)
				->hidden(fn($record): bool => $record->ended_at != null),
		];
	}

	protected function getTableFilters(): array
	{
		return [
			Filter::make("show_active_employees")
				->label("إظهار النشطين فقط")
				->query(
					fn(Builder $query, array $data): Builder => $query->active()
				),
		];
	}

	protected function getTableColumns(): array
	{
		return [
			Tables\Columns\TextColumn::make("user.name")->label("الاسم"),
			Tables\Columns\TextColumn::make("job_title")->label("مسمى وظيفي"),
			Tables\Columns\TextColumn::make("created_at")
				->label("تاريخ بدء العمل")
				->date(),
			Tables\Columns\TextColumn::make("ended_at")
				->label("تاريخ المغادرة")
				->date(),
		];
	}
}
