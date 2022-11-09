<?php

namespace App\Http\Livewire\Office\Orders;

use App\Models\Order;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Contracts\Database\Query\Builder;

class Table extends Component implements HasTable
{

    use InteractsWithTable;

    protected function getTableColumns(): array 
    {
        return [
            \Filament\Tables\Columns\TextColumn::make('id')->label('#'),
            \Filament\Tables\Columns\TextColumn::make('beneficiary.name')->label('المستفيد'),
            \Filament\Tables\Columns\TextColumn::make('subject')->label('الموضوع'),
            \Filament\Tables\Columns\TextColumn::make('fee')->label('التكلفة'),
            \Filament\Tables\Columns\TextColumn::make('status')->label(null),
            \Filament\Tables\Columns\TextColumn::make('created_at')->date()
        ];
    }

    protected function getTableQuery(): Builder 
    {

        $office = Auth::user()->currentOffice();

        return Order::where('office_id', $office->id);
    }

    public function render()
    {
        return view('livewire.office.orders.table');
    }
}
