<?php

namespace App\Filament\Resources\TransactionResource\Pages;

use App\Filament\Resources\TransactionResource;
use App\Models\Transaction;
use App\Services\TransactionService;
use Filament\Resources\Pages\ManageRecords;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions;
use Filament\Forms;

class ManageTransactions extends ManageRecords
{
    protected static string $resource = TransactionResource::class;

    protected function getTableQuery(): Builder
    {
        return parent::getTableQuery()->with('transactionable');
    }
    protected function getTableActions(): array
    {
        return [
            Actions\Action::make('accept')->action( function($action) {

                $transactionService = new TransactionService($action->getRecord());
                $transactionService->AccpetTransaction();

            })->requiresConfirmation(),
            Actions\Action::make('refuse')->action( function($action, array $data) {

                $body = $data['body'];

                if(empty($body)) {
                    abort(422);
                }

                $transactionService = new TransactionService($action->getRecord());
                $transactionService->refuseTransaction($body);

            })
            ->form([
                Forms\Components\Textarea::make('body')->label('السبب')->required()
            ])
            ->requiresConfirmation(),
            Actions\DeleteAction::make()->hidden(function ($record) {
                return $record->status == Transaction::PENDING;
            }),
        ];
    }

    protected function getActions(): array
    {
        return [
            //Actions\CreateAction::make(),
        ];
    }
}
