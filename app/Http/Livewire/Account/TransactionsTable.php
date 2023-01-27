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
			TextColumn::make("id")
				->label(__('Transaction ID')),
			TextColumn::make('amount')
				->label(__('Amount'))
				->money('sar', true),
			TextColumn::make("details")
				->label(__('Details'))
				->getStateUsing(
					fn ($record) => __(
						"transactions.details." .
							\Illuminate\Support\Str::lower($record->source),
						[
							"amount" => $record->formattedAmount,
							"order_id" => $record->id,
						]
					)
				),
			BadgeColumn::make("status")
				->label(__('Status'))
				->getStateUsing(
					fn ($record) => __(
						"transactions." . \Illuminate\Support\Str::lower($record->status)
					)
				),
			TextColumn::make('created_at')
				->label(__('Created at'))
				->date(),
			TextColumn::make('updated_at')
				->label(__('Updated at'))
				->date(),
		];
	}

	protected function getTableQuery(): Builder
	{
		return Auth::user()
			->transactions()
			->getQuery();
	}

	public function render()
	{
		return view("livewire.account.transactions-table");
	}
}
