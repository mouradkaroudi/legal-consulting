<?php

namespace App\Http\Livewire\Office\Invites;

use App\Models\Invite;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Livewire\Component;

class Table extends Component implements HasTable
{

    use InteractsWithTable;

    protected function getTableColumns(): array
    {
        return [
            \Filament\Tables\Columns\TextColumn::make('user.name')->label('الاسم'),
            \Filament\Tables\Columns\TextColumn::make('email')->label('البريد الإلكتروني'),
            \Filament\Tables\Columns\TextColumn::make('created_at')->label('تاريخ الإرسال')->date(),
        ];
    }

    protected function getTableQuery() {
        return Invite::where("office_id", auth()->user()->currentOffice->id);
    }

    public function render()
    {
        return view('livewire.office.invites.table');
    }
}
