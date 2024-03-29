<?php

namespace App\Http\Livewire\Office\Orders;

use App\Models\DigitalOffice;
use App\Models\Order;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Table extends Component implements HasTable
{
	use InteractsWithTable, AuthorizesRequests;

	public DigitalOffice $office;

	public function getTableModelLabel(): string
	{
		return __('Order');
	}

	public function getTablePluralModelLabel(): string
	{
		return __('Orders');
	}

	protected function getTableColumns(): array
	{
		return [
			\Filament\Tables\Columns\TextColumn::make("id")->label("#"),
			\Filament\Tables\Columns\TextColumn::make("beneficiary.name")->label(
				__('beneficiary')
			),
			\Filament\Tables\Columns\TextColumn::make("subject")
				->label(__('Subject')),
			\Filament\Tables\Columns\TextColumn::make("amount")
				->label(__('Amount'))
				->money("sar", true),
			\Filament\Tables\Columns\BadgeColumn::make("status")
				->label(__('Status'))
				->enum([
					Order::PAID => __("orders.paid"),
					Order::UNPAID => __("orders.unpaid"),
				]),
			\Filament\Tables\Columns\TextColumn::make("created_at")
				->label(__('Created at'))
				->date(),
		];
	}

	protected function getTableQuery(): Builder
	{
		return Order::where("office_id", $this->office->id);
	}

	protected function getTableActions(): array
	{
		return [
			\Filament\Tables\Actions\DeleteAction::make()
				->visible(fn (Order $record): bool => auth()->user()->can('delete', $record))
		];
	}

	public function render()
	{
		return view("livewire.office.orders.table");
	}
}
