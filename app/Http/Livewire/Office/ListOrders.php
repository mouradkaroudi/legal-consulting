<?php

namespace App\Http\Livewire\Office;

use App\Models\Order;
use Livewire\Component;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;

class ListOrders extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

    protected function getTableQuery(): Builder
    {
        $get_current_office = get_current_office();


        return Order::query()->where('office_id', $get_current_office['id']);
    }

    public function render()
    {
        return view('livewire.office.list-orders');
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('beneficiary.name'),
            Tables\Columns\TextColumn::make('subject'),
            Tables\Columns\TextColumn::make('fee'),
            Tables\Columns\TextColumn::make('status'),
            Tables\Columns\TextColumn::make('created_at'),
            Tables\Columns\TextColumn::make('updated_at'),
            Tables\Columns\TextColumn::make('closed_at'),
        ];
    }
}
