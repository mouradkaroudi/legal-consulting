<?php

namespace App\Http\Livewire\Account;

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

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('office.name')->label('المكتب'),
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
        return fn (Model $record): string => route('account.messages.show', ['id' => $record->id]);
    }

    protected function getTableQuery(): Builder|Relation
    {
        
        return Thread::query()->where('user_id', auth()->user()->id);
    }

    public function render()
    {
        return view('livewire.account.messages-table');
    }
}
