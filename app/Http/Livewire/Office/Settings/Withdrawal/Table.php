<?php

namespace App\Http\Livewire\Office\Settings\Withdrawal;

use App\Models\WithdrawalMethod;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables;
use Filament\Tables\Actions\EditAction;

class Table extends Component implements HasTable
{

    use InteractsWithTable;

    protected function getTableQuery(): Builder
    {
        return WithdrawalMethod::query()->available();
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make("name")
                ->label(__("Name")),

            Tables\Columns\TextColumn::make("description")
                ->label(__("Description")),
        ];
    }

    protected function getTableActions(): array
    {
        return [
            EditAction::make()
        ];
    }

    public function render()
    {
        return view('livewire.office.settings.withdrawal.table');
    }
}
