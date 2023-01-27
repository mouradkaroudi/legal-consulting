<?php

namespace App\Http\Livewire\Account;

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

  protected function getTableColumns(): array
  {
    return [
      TextColumn::make("office.name")
        ->label(__('Office name')),
      TextColumn::make("subject")
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
    return fn (Model $record): string => route("account.messages.show", [
      "id" => $record->id,
    ]);
  }

  protected function getTableRecordClassesUsing(): ?Closure
  {
    return function ($record) {
      $user_id = Auth::id();
      return $record->isUnread($user_id) ? "bg-gray-200" : "";
    };
  }

  protected function getTableQuery(): Builder|Relation
  {
    return Thread::query()
      ->where('user_id', Auth::id())
      ->latest("updated_at");
  }

  public function render()
  {
    return view("livewire.account.messages-table");
  }
}
