<?php

namespace App\Http\Livewire\Account\Orders;

use App\Models\Order;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Livewire\Component;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\Layout\Grid;
use Filament\Tables\Columns\Layout\Stack;

class PaymentSummary extends Component implements HasTable
{
  use InteractsWithTable;

  protected function getTableColumns(): array
  {
    return [
      TextColumn::make("office.name")->label('المكتب'),
      TextColumn::make("subject")->label("الموضوع"),
      TextColumn::make("fee")->label("التكلفة")
    ];
  }

  protected function isTablePaginationEnabled(): bool
  {
    return false;
  }

  protected function getTableQuery(): Builder|Relation
  {
    return Order::where("id", 1);
  }

  public function render()
  {
    return view("livewire.account.orders.payment-summary");
  }
}
