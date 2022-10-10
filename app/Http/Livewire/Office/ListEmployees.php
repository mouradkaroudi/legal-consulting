<?php

namespace App\Http\Livewire\Office;

use App\Models\DigitalOffice;
use Filament\Tables;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class ListEmployees extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

    protected function getTableQuery(): Builder
    {
        return DigitalOffice::query();
    }

    public function render()
    {
        return view('livewire.office.list-employees');
    }
}
