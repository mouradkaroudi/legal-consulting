<?php

namespace App\Filament\Resources\TransactionResource\Pages;

use App\Filament\Resources\TransactionResource;
use App\Models\Transaction;
use App\Services\TransactionService;
use Filament\Resources\Pages\ManageRecords;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions;
use Filament\Forms;
use Illuminate\Support\Arr;

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

		$transactionService = new TransactionService(
			Transaction::find($txn['id'])
		);
		$transactionService->AccpetTransaction();
	}

	public function refuse()
	{
		$txn = $this->mountedTableActionData;

		$transactionService = new TransactionService(
			Transaction::find($txn['id'])
		);
		$transactionService->refuseTransaction('');
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
							->label('موافقة')
							->action("accept")
							->color("success"),
						$action
							->makeModalAction("refuse")
							->button()
							->label('رفض')
							->action("refuse", ["txn_id" => $record->id])
							->color("danger"),
					]
				)
                ->modalContent(view('filament.resources.transactions.details'))
				->visible(fn($record) => $record->status === Transaction::PENDING)
				->form([Forms\Components\Textarea::make("notes")->label("ملاحظات")]),
		];
	}
}
