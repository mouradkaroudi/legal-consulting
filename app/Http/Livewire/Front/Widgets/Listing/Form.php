<?php

namespace App\Http\Livewire\Front\Widgets\Listing;

use App\Models\Country;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Livewire\Component;

class Form extends Component implements HasForms
{

    use InteractsWithForms;
    
    public $officeName;
    public $countryId;
    public $cityId;

    protected function getFormSchema(): array
    {
        return [
            \Filament\Forms\Components\Card::make()->schema([
                \Filament\Forms\Components\TextInput::make('officeName'),
                \Filament\Forms\Components\Select::make('countryId')
                ->reactive()
                ->options(Country::all()->pluck('name', 'id')),
                \Filament\Forms\Components\Select::make('cityId')
                    ->reactive()
                    ->options(function(callable $get) {
                    $countryId = $get('countryId');
                    if(!$countryId) {
                        return [];
                    }

                    $country = Country::find($countryId);

                    return $country->cities->pluck('name', 'id');

                }),
                \Filament\Forms\Components\Select::make('professionId'),
                \Filament\Forms\Components\Select::make('specializationId'),
            ])->columns(3)
        ];
    }

    public function render()
    {
        return view('livewire.front.widgets.listing.form');
    }
}
