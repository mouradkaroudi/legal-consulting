<?php

namespace App\Http\Livewire\Account;

use App\Models\Transaction;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class TransactionsTable extends Component implements Tables\Contracts\HasTable 
{
    use Tables\Concerns\InteractsWithTable;

    protected function getTableColumns(): array 
    {
        return [
            TextColumn::make('id')->label('رقم التحويل'),
            TextColumn::make('amount')->label('المبلغ'),
            TextColumn::make('created_at')->date()
        ];
    }

    protected function getTableQuery(): Builder 
    {
        return Transaction::query()->where('status', 'completed');
    } 

    public function render()
    {
        return view('livewire.account.transactions-table');
    }
}
