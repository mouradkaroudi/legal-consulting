<?php

namespace App\Http\Livewire\Office;

use App\Models\Thread;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Livewire\Component;
use Closure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class MessagesTable extends Component implements HasTable
{

    use InteractsWithTable;

    public $officeId = 0;

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('sender.name')
                ->label(__('Beneficiary')),
            TextColumn::make('subject')
                ->label(__('Subject')),
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
            'office.threads.show',
            ['digitalOffice' => $this->officeId, 'thread' => $record->id]
        );
    }

    protected function getTableRecordClassesUsing(): ?Closure
    {
        return function ($record) {
            $user = Auth::user();
            return $record->isUnread($user->officeEmployment($user->currentOffice)) ? "bg-gray-200" : "";
        };
    }

    protected function getTableQuery(): Builder|Relation
    {
        $user = Auth::user();
        return Thread::query()->forOffice($user->currentOffice)->latest("updated_at");
    }

    public function render()
    {
        return view('livewire.office.messages-table');
    }
}
