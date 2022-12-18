<?php

namespace App\Http\Livewire\Account\Orders;

use App\Models\Order;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\EditAction;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Support\HtmlString;

class Table extends Component implements HasTable
{
	use InteractsWithTable;

	protected function getTableColumns(): array
	{
		return [
			\Filament\Tables\Columns\TextColumn::make("id")->label("#"),
			\Filament\Tables\Columns\TextColumn::make("office.name")->label("المكتب"),
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
				->date()
				->label("تاريخ الإنشاء"),
		];
	}

	protected function getTableActions(): array
	{
		return [
			EditAction::make("pay")
				->mountUsing(
					fn(Forms\ComponentContainer $form, Order $record) => $form->fill([
						"authorId" => $record->id,
					])
				)
                ->modalActions(
					fn($action, $record) => [
						$action
							->makeModalAction("pay")
							->button()
							->label('دفع')
							->action("pay")
					]
				)
                ->modalContent()
				->form([
					Forms\Components\Select::make("authorId")
						->label("Author")
						->options(Order::query()->pluck("fee", "id"))
						->required(),
				]),
		];
	}

	protected function getTableQuery(): Builder
	{
		return Order::where("beneficiary_id", Auth::id());
	}

	public function render()
	{
		return view("livewire.office.orders.table");
	}
}
