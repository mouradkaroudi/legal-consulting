<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransactionResource\Pages;
use App\Models\Transaction;

use Filament\Resources\Resource;
use Filament\Resources\Table;


class TransactionResource extends Resource
{
	protected static ?string $model = Transaction::class;

	protected static ?string $navigationIcon = "heroicon-o-collection";

	protected static function getNavigationLabel(): string
	{
		return static::$navigationLabel ?? static::$navigationLabel ?? __('filament::resources/transactions.label.plural');
	}

	public static function getPluralModelLabel(): string
	{
		return static::$pluralModelLabel ?? static::$pluralModelLabel ?? __('filament::resources/transactions.label.plural');
	}

	public static function getModelLabel(): string
	{
		return static::$modelLabel ?? static::$modelLabel ?? __('filament::resources/transactions.label.singular');
	}

	protected static function getNavigationGroup(): ?string
    {
        return __('Financial Management');
    }

	public static function table(Table $table): Table
	{

		return $table
			->columns([
				\Filament\Tables\Columns\TextColumn::make("from")
					->label(__('filament::resources/transactions.table.columns.from.label'))
					->getStateUsing(fn ($record) => $record->transactionable->name),
				\Filament\Tables\Columns\TextColumn::make("amount")
					->label(__('filament::resources/transactions.table.columns.amount.label'))
					->money('SAR', true),
				\Filament\Tables\Columns\TextColumn::make("source")
					->label(__('filament::resources/transactions.table.columns.source.label'))
					->enum([
						Transaction::RECEIVE_EARNINGS => __(
							"transactions.receive_earnings"
						),
						Transaction::RECHARGE => __("transactions.recharge"),
						Transaction::PAY_DUES => __("transactions.pay_dues"),
					]),
				\Filament\Tables\Columns\BadgeColumn::make("status")
					->label(__('filament::resources/transactions.table.columns.status.label'))
					->enum([
						Transaction::SUCCESS => __("transactions.success"),
						Transaction::PENDING => __("transactions.pending"),
					]),
				\Filament\Tables\Columns\TextColumn::make("created_at")
					->label(__('filament::resources/transactions.table.columns.created_at.label')),
				\Filament\Tables\Columns\TextColumn::make("due_date")
					->label(__('filament::resources/transactions.table.columns.due_date.label')),
			])
			->filters([
				//
			]);
	}

	public static function getPages(): array
	{
		return [
			"index" => Pages\ManageTransactions::route("/"),
		];
	}
}
