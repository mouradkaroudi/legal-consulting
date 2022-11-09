<?php

namespace App\Http\Livewire\Account\Orders;

use App\Models\Order;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\TextInput;
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
            \Filament\Tables\Columns\TextColumn::make('office.name')->label('المكتب'),
            \Filament\Tables\Columns\TextColumn::make('subject')->label('الموضوع'),
            \Filament\Tables\Columns\TextColumn::make('fee')->label('التكلفة'),
            \Filament\Tables\Columns\TextColumn::make('status')->label(null),
            \Filament\Tables\Columns\TextColumn::make('created_at')->date()
        ];
    }

    protected function getTableActions(): array
    {
        return [
            Action::make('pay')->url(fn (Order $record): string => route('account.orders.pay', $record))
        ];
    }

    protected function getTableQuery(): Builder 
    {
        return Order::where('beneficiary_id', Auth::id());
    }

    public function render()
    {
        return view('livewire.office.orders.table');
    }
}
