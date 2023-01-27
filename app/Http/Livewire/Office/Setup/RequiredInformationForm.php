<?php

namespace App\Http\Livewire\Office\Setup;

use App\Models\City;
use App\Models\Country;
use App\Models\DigitalOffice;
use App\Models\Profession;
use App\Models\ProfessionSubscriptionPlan;
use App\Models\Service;
use App\Models\Subscription;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Livewire\Component;
use Filament\Forms;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class RequiredInformationForm extends Component implements HasForms
{

    use InteractsWithForms, AuthorizesRequests;

    public $digitalOffice;

    protected function getFormModel(): DigitalOffice
    {
        return $this->digitalOffice;
    }

    public function mount(): void
    {

        $this->digitalOffice = auth()->user()->currentOffice;

        $this->form->fill($this->digitalOffice->toArray());
    }

    public function submit()
    {

        $data = $this->form->getState();

        $directRegistration = get_option('digital_office_direct_registration');
        $subscriptionEnabled = Subscription::isEnabled();

        $status =  ($subscriptionEnabled && !empty(ProfessionSubscriptionPlan::find($data['profession_id'])))
            ? DigitalOffice::PENDING_PAYMENT : ($directRegistration ? DigitalOffice::AVAILABLE : DigitalOffice::PENDING);

        $this->digitalOffice->update([
            'name' => $data['name'],
            'service_id' => $data['service_id'],
            'profession_id' => $data['profession_id'],
            'commercial_registration_number' => $data['commercial_registration_number'],
            'country_code' => $data['country_code'],
            'city' => $data['city'],
            'status' => $status
        ]);

        if ($status === DigitalOffice::PENDING) {
            return redirect()->route('office.setup.approval');
        }

        if ($status === DigitalOffice::AVAILABLE) {
            return redirect()->route('office.overview');
        }

        if ($status === DigitalOffice::PENDING_PAYMENT) {
            return redirect()->route('office.subscription.index');
        }
    }

    protected function getFormSchema(): array
    {
        $countries = Country::all()->pluck("name", "id");

        return [
            Forms\Components\Card::make([
                Forms\Components\TextInput::make("name")
                    ->label(__('Office name'))
                    ->required(),
                Forms\Components\Grid::make(2)
                    ->schema([
                        Forms\Components\Select::make("service_id")
                            ->label(__('Select a service'))
                            ->relationship("service", "name")
                            ->reactive()
                            ->preload()
                            ->exists(table: Service::class, column: 'id')
                            ->required(),
                        Forms\Components\Select::make("profession_id")
                            ->label(__('Select a profession'))
                            ->exists(table: Profession::class, column: 'id')
                            ->relationship("profession", "name")
                            ->reactive()
                            ->options(function (callable $get) {
                                $serviceId = $get("service_id");

                                if (!$serviceId) {
                                    return [];
                                }

                                $service = Service::find($serviceId);
                                return $service->professions->pluck("name", "id");
                            })
                            ->required(),
                        Forms\Components\TextInput::make("commercial_registration_number")
                            ->label(__('Commercial registre number'))
                            ->unique(table: DigitalOffice::class, column: 'commercial_registration_number')
                            ->required(),
                        Forms\Components\Grid::make(2)->schema([
                            Forms\Components\Select::make("country_code")
                                ->label(__('Country'))
                                ->exists(table: Country::class, column: 'id')
                                ->options($countries)
                                ->reactive()
                                ->required(),
                            Forms\Components\Select::make("city")
                                ->label(__('City'))
                                ->exists(table: City::class, column: 'id')
                                ->reactive()
                                ->options(function (callable $get) {
                                    $countryId = $get("country_code");
                                    if (!$countryId) {
                                        return [];
                                    }
                                    $country = Country::find($countryId);
                                    return $country->cities->pluck("name", "id");
                                }),
                        ]),

                    ])

            ])
        ];
    }

    public function render()
    {
        return view('livewire.office.setup.required-information-form');
    }
}
