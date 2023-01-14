<?php

namespace App\Http\Livewire\Office;

use App\Models\Withdrawal;
use App\Models\WithdrawalMethod;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Livewire\Component;
use Suleymanozev\FilamentRadioButtonField\Forms\Components\RadioButton;

class WithdrawalMethodsForm extends Component implements HasForms
{

    use InteractsWithForms;

    protected function getFormSchema(): array
    {
        $withDrawalMethods = WithdrawalMethod::all();

        foreach( $withDrawalMethods as $withDrawalMethod ) {

            $requiredFields = [];

            $informationRequired = $withDrawalMethod->information_required;

            foreach($informationRequired as $i=>$field) {
                $requiredFields[] = TextInput::make('field_' . $i)->label($field['field_label']);
            }

            $withDrawalMethodsForm[] = Tab::make($withDrawalMethod->name)->schema($requiredFields);
        }
        /*
        $withDrawalMethodsForm[] = RadioButton::make("withdrawalMethod")
        ->label("أختر طريقة السحب")
        ->options($withDrawalMethods)
        ->required();
        */

        return [
            Tabs::make('طرق السحب')->tabs(
                $withDrawalMethodsForm
            )
        ];
    }

    public function render()
    {
        return view('livewire.office.withdrawal-methods-form');
    }
}
