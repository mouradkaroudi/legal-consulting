<?php

namespace App\Http\Livewire\Office\Settings\Withdrawal;

use App\Models\WithdrawalMethod;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables;
use Filament\Forms;
use Illuminate\Database\Eloquent\Model;

class Table extends Component implements HasTable
{

    use InteractsWithTable;

    protected function getTableEmptyStateDescription(): ?string
    {
        return __('There is no withdrawal method available for you. Please get in touch with our support') . '.';
    }

    public function getTableRecordTitle(Model $record): string
    {
        return $record->name;
    }

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
            Tables\Actions\EditAction::make('add')
                ->action(function ($record, $data) {
                    // TODO: check if office have the ability to add a particular method

                    $withdrawals = auth()->user()->currentOffice->withdrawal_methods ?? [];
                    $office = auth()->user()->currentOffice;

                    if (!empty($withdrawals) && is_array($withdrawals)) {
                        $index = array_search($data['method_id'], array_column($withdrawals, 'method_id'));
                        if ($index === false) {
                            $withdrawals[] = $data;
                        } else {
                            $withdrawals[$index] = $data;
                        }
                    } else {
                        $withdrawals[] = $data;
                    }

                    $office->withdrawal_methods = $withdrawals;
                    $office->save();
                })
                ->mountUsing(function (Forms\ComponentContainer $form, $record) {

                    $withdrawals = auth()->user()->currentOffice->withdrawal_methods ?? [];
                    $data = [
                        "method_id" => $record->id
                    ];

                    if (!empty($withdrawals) && is_array($withdrawals)) {
                        $currentMethodIndex = array_search($record->id, array_column($withdrawals, 'method_id'));
                        if ($currentMethodIndex !== false) {
                            $currentMethod = $withdrawals[$currentMethodIndex];
                            $data = $currentMethod;
                        }
                    }

                    $form->fill($data);
                })
                ->form(function ($record) {

                    $schema = [Forms\Components\Hidden::make('method_id')];

                    foreach ($record->information_required as $k => $field) {
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
