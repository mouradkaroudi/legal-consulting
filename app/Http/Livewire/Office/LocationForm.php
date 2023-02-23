<?php

namespace App\Http\Livewire\Office;

use App\Models\Country;
use App\Models\DigitalOffice;
use Livewire\Component;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Notifications\Notification;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Yemenpoint\FilamentGoogleMapLocationPicker\Forms\Components\LocationPicker;

class LocationForm extends Component implements Forms\Contracts\HasForms
{
	use Forms\Concerns\InteractsWithForms, AuthorizesRequests;

	public DigitalOffice $digitalOffice;

	public function mount(): void
	{
		$this->form->fill([
			"country_code" => $this->digitalOffice->country_code,
			"city" => $this->digitalOffice->city,
			"location" => $this->digitalOffice->location,
		]);
	}

	protected function getFormSchema(): array
	{
		$countries = Country::all()->pluck("name", "id");

		return [
			Grid::make(2)->schema([
				Forms\Components\Select::make("country_code")
					->label(__('Country'))
					->options($countries)
					->required()
					->exists(table: Country::class, column: 'id')
                    ->reactive(),
				Forms\Components\Select::make("city")
					->label(__('City'))
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
			LocationPicker::make("location")
				->label(__('Geographical location')),
		];
	}

	public function save(): void
	{
	}

	public function submit(): void
	{
		$this->authorize("update", $this->digitalOffice);
		$data = $this->form->getState();

		$this->digitalOffice->update($data);
		Notification::make()
			->title(__('The information has been updated successfully'))
			->success()
			->send();
	}

	protected function getFormModel(): DigitalOffice
	{
		return $this->digitalOffice;
	}

	public function render()
	{
		return view("livewire.office.location-form");
	}
}
