<?php

namespace App\Http\Livewire\Office;

use App\Models\DigitalOfficeEmployee;
use Livewire\Component;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;

class ListEmployees extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

    protected function getTableQuery(): Builder 
    {
        return DigitalOfficeEmployee::query()->with('user');
    } 

    public function render()
    {
        return view('livewire.office.list-office-employees');
    }

    protected function getTableColumns(): array 
    {
        return [
            Tables\Columns\TextColumn::make('user_id'),
            Tables\Columns\TextColumn::make('user.name'),
            Tables\Columns\TextColumn::make('role_name'),
        ];
    }

}
