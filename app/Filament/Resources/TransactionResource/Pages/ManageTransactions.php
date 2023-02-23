<?php

namespace App\Filament\Resources\TransactionResource\Pages;

use App\Filament\Resources\TransactionResource;
use App\Models\Transaction;
use App\Services\TransactionService;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ManageRecords;
use Filament\Support\Actions\Concerns\CanNotify;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions;
use Filament\Tables\Filters;

class ManageTransactions extends ManageRecords
{

	use CanNotify;

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

		Notification::make()
			->body(__('filament-support::actions/edit.single.messages.saved'))
			->success()
			->send();

	}

	public function refuse()
	{
		$txn = $this->mountedTableActionData;
		$transactionService = new TransactionService(Transaction::find($txn["id"]));
		$transactionService->rejectTransaction();
	}

	protected function getTableActions(): array
	{
		return [
			Actions\EditAction::make()
				->modalActions(
					fn ($action, $record) => [
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
				->modalContent(fn ($record) => view("filament.resources.transactions.details", compact('record')))
		];
	}

	protected function getTableFilters(): array
	{
		return [
			Filters\SelectFilter::make("source")
				->label(__('filament::resources/transactions.table.filters.source.label'))
				->options([
					Transaction::RECEIVE_EARNINGS => __('transactions.receive_earnings'),
					Transaction::PAY_DUES => __('transactions.' . Transaction::PAY_DUES),
					Transaction::DEPOSIT => __('transactions.' . Transaction::DEPOSIT),
					Transaction::WITHDRAWALS => __('transactions.' . Transaction::WITHDRAWALS),
					Transaction::SUBSCRIPTION_FEES => __("transactions.subscription_fees"),
					Transaction::BANK_TRANSFER => __("transactions.bank_transfer"),
				])
				->attribute('source'),
			Filters\SelectFilter::make("status")
				->label(__('filament::resources/transactions.table.filters.status.label'))
				->options([
					Transaction::SUCCESS => __('transactions.' . Transaction::SUCCESS),
					Transaction::PENDING => __('transactions.' . Transaction::PENDING),
					Transaction::REJECTED => __('transactions.' . Transaction::REJECTED),
					Transaction::FAILED => __('transactions.' . Transaction::FAILED),
				])
				->attribute('status')
		];
	}
}
