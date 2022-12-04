<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransactionResource\Pages;
use App\Filament\Resources\TransactionResource\RelationManagers;
use App\Models\Transaction;
use App\Models\User;
use App\Services\TransactionService;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\ViewAction;
use Illuminate\Database\Eloquent\Builder;

class TransactionResource extends Resource
{
	protected static ?string $model = Transaction::class;

	protected static ?string $navigationIcon = "heroicon-o-collection";
	protected static ?string $navigationGroup = "Finance";

	public static function table(Table $table): Table
	{

		return $table
			->columns([
				\Filament\Tables\Columns\TextColumn::make("from")
					->label("من طرف")
					->getStateUsing(fn($record) => $record->transactionable->name),
				\Filament\Tables\Columns\TextColumn::make("amount")->label("المبلغ")->money('SAR', true),
				\Filament\Tables\Columns\TextColumn::make("source")
					->enum([
						Transaction::RECEIVE_EARNINGS => __(
							"transactions.receive_earnings"
						),
						Transaction::RECHARGE => __("transactions.recharge"),
						Transaction::PAY_DUES => __("transactions.pay_dues"),
					])
					->label("المصدر"),
				\Filament\Tables\Columns\BadgeColumn::make("status")
					->enum([
						Transaction::SUCCESS => __("transactions.success"),
						Transaction::PENDING => __("transactions.pending"),
					])
					->label("الحالة"),
				\Filament\Tables\Columns\TextColumn::make("created_at")->label(
					"تاريخ التحويل"
				),
				\Filament\Tables\Columns\TextColumn::make("due_date")->label(
					"تاريخ الإستحقاق"
				),
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
