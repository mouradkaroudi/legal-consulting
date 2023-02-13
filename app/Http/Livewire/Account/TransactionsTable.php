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

	protected function getTableActions(): array
	{
		return [
			Tables\Actions\Action::make('print')
			->label(__('Print'))
			->url(fn($record) => route('account.credit.receipt', ['txn' => $record->id]))
			->openUrlInNewTab()
			->visible(fn($record) => in_array($record->source, [Transaction::DEPOSIT, Transaction::WITHDRAWALS]))
		];
	}

	protected function getTableColumns(): array
	{
		return [
			TextColumn::make("id")
				->label(__('Transaction ID')),
			TextColumn::make('actual_amount')
				->label(__('Amount'))
				->money('sar', true),
			TextColumn::make("description")
				->label(__('Details')),
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
