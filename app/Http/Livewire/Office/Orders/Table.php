<?php

namespace App\Http\Livewire\Office\Orders;

use App\Models\DigitalOffice;
use App\Models\Order;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Contracts\Database\Query\Builder;

class Table extends Component implements HasTable
{
	use InteractsWithTable;

	public DigitalOffice $office;

    public function getTableModelLabel(): string
    {
        return 'الطلب';
    }

    public function getTablePluralModelLabel(): string
    {
        return 'الطلبات';
    }

	protected function getTableColumns(): array
	{
		return [
			\Filament\Tables\Columns\TextColumn::make("id")->label("#"),
			\Filament\Tables\Columns\TextColumn::make("beneficiary.name")->label(
				"المستفيد"
			),
			\Filament\Tables\Columns\TextColumn::make("subject")->label("الموضوع"),
			\Filament\Tables\Columns\TextColumn::make("fee")
				->label("التكلفة")
				->money("sar", true),
			\Filament\Tables\Columns\BadgeColumn::make("status")
				->label("الحالة")
				->enum([
					Order::PAID => __("orders.paid"),
					Order::UNPAID => __("orders.unpaid"),
				]),
			\Filament\Tables\Columns\TextColumn::make("created_at")
				->label("تاريخ الإصدار")
				->date(),
		];
	}

	protected function getTableQuery(): Builder
	{
		return Order::where("office_id", $this->office->id);
	}

	protected function getTableActions(): array
	{
		return [\Filament\Tables\Actions\DeleteAction::make()];
	}

	public function render()
	{
		return view("livewire.office.orders.table");
	}
}
