<?php

namespace App\Filament\Resources\TransactionResource\Pages;

use App\Filament\Resources\TransactionResource;
use App\Models\Transaction;
use App\Services\TransactionService;
use Filament\Resources\Pages\ManageRecords;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions;
use Filament\Tables\Filters;
use Filament\Forms;
use Illuminate\Support\Str;

class ManageTransactions extends ManageRecords
{
	protected static string $resource = TransactionResource::class;

	protected function getTableQuery(): Builder
	{
		return parent::getTableQuery()
			->with("transactionable")
			->latest();
	}

	public function accept()
	{
		$txn = $this->mountedTableActionData;

		$transactionService = new TransactionService(Transaction::find($txn["id"]));
		$transactionService->AccpetTransaction();
	}

	public function refuse()
	{
		$txn = $this->mountedTableActionData;

		$transactionService = new TransactionService(Transaction::find($txn["id"]));
		$transactionService->refuseTransaction("");
	}

	protected function getTableActions(): array
	{
		return [
			Actions\EditAction::make()
				->modalActions(
					fn($action, $record) => [
						$action
							->makeModalAction("accept")
							->button()
							->label(__('Accept'))
							->action("accept")
							->visible($record->status === Transaction::PENDING)
							->color("success"),
						$action
							->makeModalAction("refuse")
							->button()
							->label(__('Reject'))
							->visible($record->status === Transaction::PENDING)
							->action("refuse", ["txn_id" => $record->id])
							->color("danger"),
					]
				)
				->modalContent(fn($record) => view("filament.resources.transactions.details", compact('record')))
				//->form([Forms\Components\Textarea::make("notes")->label("ملاحظات")]),
		];
	}

	protected function getTableFilters(): array
	{
		return [
			Filters\SelectFilter::make("source")
			->label(__('filament::resources/transactions.table.filters.source.label'))
			->options([
					Transaction::RECEIVE_EARNINGS => __('transactions.' . Transaction::RECEIVE_EARNINGS),
					Transaction::PAY_DUES => __('transactions.' . Transaction::PAY_DUES),
					Transaction::DEPOSIT => __('transactions.' . Transaction::DEPOSIT),
					Transaction::WITHDRAWALS => __('transactions.' . Transaction::WITHDRAWALS),
				])
				->attribute('source'),
			Filters\SelectFilter::make("status")
				->label(__('filament::resources/transactions.table.filters.status.label'))
				->options([
					Transaction::SUCCESS => __('transactions.' . Transaction::SUCCESS),
					Transaction::PENDING => __('transactions.' . Transaction::PENDING),
					Transaction::FAILED => __('transactions.' . Transaction::FAILED),
				])
				->attribute('status')
		];
	}
}
