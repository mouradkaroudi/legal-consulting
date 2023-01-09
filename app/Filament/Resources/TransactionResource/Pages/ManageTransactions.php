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
use Illuminate\Support\Arr;
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
							->label("موافقة")
							->action("accept")
							->color("success"),
						$action
							->makeModalAction("refuse")
							->button()
							->label("رفض")
							->action("refuse", ["txn_id" => $record->id])
							->color("danger"),
					]
				)
				->modalContent(view("filament.resources.transactions.details"))
				->visible(fn($record) => $record->status === Transaction::PENDING)
				->form([Forms\Components\Textarea::make("notes")->label("ملاحظات")]),
		];
	}

	protected function getTableFilters(): array
	{
		return [
			Filters\SelectFilter::make("source")
				->label("مصدر المعاملة")
				->options([
					Transaction::RECEIVE_EARNINGS => __('transactions.' . Str::lower(Transaction::RECEIVE_EARNINGS)),
					Transaction::PAY_DUES => __('transactions.' . Str::lower(Transaction::PAY_DUES)),
					Transaction::RECHARGE => __('transactions.' . Str::lower(Transaction::RECHARGE)),
					Transaction::WITHDRAWALS => __('transactions.' . Str::lower(Transaction::WITHDRAWALS)),
				])
				->attribute('source'),
			Filters\SelectFilter::make("status")
				->label("الحالة")
				->options([
					Transaction::SUCCESS => __('transactions.' . Str::lower(Transaction::SUCCESS)),
					Transaction::PENDING => __('transactions.' . Str::lower(Transaction::PENDING)),
					Transaction::FAILED => __('transactions.' . Str::lower(Transaction::FAILED)),
				])
				->attribute('status')
		];
	}
}
