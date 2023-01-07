<?php

namespace App\Http\Livewire\Account\Invites;

use App\Models\Invite;
use App\Services\InviteService;
use Filament\Tables\Actions\Action;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Livewire\Component;

class Table extends Component implements HasTable
{
	use InteractsWithTable;

	protected function getTableColumns(): array
	{
		return [
			\Filament\Tables\Columns\TextColumn::make("office.name")->label("المكتب"),
			\Filament\Tables\Columns\TextColumn::make("created_at")->label(
				"تاريخ الإرسال"
			),
		];
	}

	protected function getTableActions(): array
	{
		return [
			Action::make("accpet")
				->label("قبول الدعوة")
                ->action(function (Invite $record, array $data): void {
					InviteService::accept($record);
				})
				->button(),
			Action::make("decline")
				->label("رفض الدعوة")
				->action(function (Invite $record, array $data): void {
					$record->delete();
				})
				->color("danger"),
		];
	}

	protected function getTableQuery(): Builder|Relation
	{
		return Invite::where("email", auth()->user()->email);
	}

	public function render()
	{
		return view("livewire.account.invites.table");
	}
}
