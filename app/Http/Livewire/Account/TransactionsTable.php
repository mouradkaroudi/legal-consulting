<?php

namespace App\Http\Livewire\Account;

use App\Models\Transaction;
use App\Models\User;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TransactionsTable extends Component implements Tables\Contracts\HasTable
{
	use Tables\Concerns\InteractsWithTable;

	protected function getTableColumns(): array
	{
		return [
			TextColumn::make("id")->label("رقم التحويل"),
			TextColumn::make("details")
				->label("التفاصيل")
				->getStateUsing(
					fn($record) => __(
						"transactions.details." .
							\Illuminate\Support\Str::lower($record->source),
						[
							"amount" => $record->formattedAmount,
							"order_id" => $record->id,
						]
					)
				),
			BadgeColumn::make("status")->label('الحالة')->getStateUsing(
				fn($record) => __(
					"transactions." . \Illuminate\Support\Str::lower($record->status)
				)
			),
			TextColumn::make('created_at')->label("تاريخ المعاملة")->date(),
			TextColumn::make('updated_at')->label("آخر تحديث")->date(),
		];
	}

	protected function getTableQuery(): Builder
	{
		return Auth::user()
			->transactions()
            ->latest()
			->getQuery();
	}

	public function render()
	{
		return view("livewire.account.transactions-table");
	}
}
