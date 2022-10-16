<?php

namespace App\Http\Livewire\Office;

use App\Models\Thread;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Livewire\Component;
use Closure;
use Illuminate\Database\Eloquent\Model;

class MessagesTable extends Component implements HasTable
{

    use InteractsWithTable;

    public $officeId = 0;

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('office.name')->label('المستفيد'),
            TextColumn::make('subject')->label('الموضوع'),
        ];
    }

    protected function getTableActions(): array
    {
        return [
            // Action::make('edit'),
        ];
    }

    protected function getTableRecordUrlUsing(): Closure
    {
        return fn (Model $record): string => route(
            'officemessages.show', ['digitalOffice' => $this->officeId, 'message' => $record->id]
        );
    }

    protected function getTableQuery(): Builder|Relation
    {
        return Thread::query();
    }

    public function render()
    {
        return view('livewire.office.messages-table');
    }
}
