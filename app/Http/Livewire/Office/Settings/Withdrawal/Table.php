<?php

namespace App\Http\Livewire\Office\Settings\Withdrawal;

use App\Models\WithdrawalMethod;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables;
use Filament\Forms;

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
            Tables\Actions\Action::make('add')
                ->action(function ($record, $data) {
                    $office = auth()->user()->currentOffice;
                    $office->withdrawal_methods = json_encode($data);
                    $office->save();
                })
                ->form(function ($record) {

                    $schema = [Forms\Components\Hidden::make('method_id')];

                    foreach($record->information_required as $k=>$field) {
                        $schema[] = Forms\Components\TextInput::make('field_' . $k)->label($field['field_label']);
                    }

                    return $schema;
                })
        ];
    }

    public function render()
    {
        return view('livewire.office.settings.withdrawal.table');
    }
}
