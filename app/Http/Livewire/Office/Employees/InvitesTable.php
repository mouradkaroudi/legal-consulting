<?php

namespace App\Http\Livewire\Office\Employees;

use App\Models\Invite;
use Closure;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\Modal\Actions\Action;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Contracts\Support\Htmlable;
use Livewire\Component;

class InvitesTable extends Component implements HasTable
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

    protected function getTableHeading(): string|Htmlable|Closure|null
    {
        return 'دعوات في انتظار الموافقة';
    }

    protected function getTableQuery() {
        return Invite::where("office_id", auth()->user()->currentOffice->id);
    }

    public function render()
    {
        return view('livewire.office.employees.invites-table');
    }
}
