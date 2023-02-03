<?php

namespace App\Http\Livewire\Office;

use App\Models\Withdrawal;
use App\Models\WithdrawalMethod;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Placeholder;
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
        $office = auth()->user()->currentOffice;

        $withDrawalMethods = WithdrawalMethod::all();

        $withDrawalMethodsForm = [];

        foreach ($withDrawalMethods as $j=>$withDrawalMethod) {

            $requiredFields = [];
            $availableIn = $withDrawalMethod->countries->pluck('id')->toArray();

            if( !empty($availableIn) && !in_array($office->country_code, $availableIn) ) {
                continue;
            }

            $informationRequired = $withDrawalMethod->information_required;

            foreach ($informationRequired as $i => $field) {
                $requiredFields[] = TextInput::make('method[' . $j . '][field][' . $i . ']')->label($field['field_label']);
            }

            $withDrawalMethodsForm[] = Tab::make($withDrawalMethod->name)->schema($requiredFields);
        }

        if (empty($withDrawalMethodsForm)) {
            return [
                Placeholder::make('')->content(__('There is no payment method available for you. Please get in touch with our support') . '.')
            ];
        } else {
            return [
                TextInput::make('s')
            ];
            return [
                Tabs::make(__('Withdrawals methods'))
                    ->label(__('Fill in your preferred withdrawal methods'))
                    ->tabs($withDrawalMethodsForm)
            ];
        }
    }

    public function submit() {
        dd($this->form);
    }
 
    public function render()
    {
        return view('livewire.office.withdrawal-methods-form');
    }
}
