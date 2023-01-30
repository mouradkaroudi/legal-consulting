<?php

namespace App\Http\Livewire\Front\Widgets;

use App\Models\DigitalOffice;
use App\Models\Country;
use App\Models\Profession;
use App\Models\Service;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Livewire\Component;

class ListOffices extends Component implements HasForms
{
	use InteractsWithForms;

    public $officeName = '';
	public Service $service;
	public Profession $profession;
	public $countryId;
	public $cityId;
	public $professionId;
	public $specializationsIds;
    
    protected $queryString = ['officeName', 'countryId', 'cityId', 'professionId', 'specializationsIds'];

	protected function getForms(): array
	{
		return [
			"mainForm" => $this->makeForm()->schema($this->getMainFormSchema()),
			"locationForm" => $this->makeForm()->schema(
				$this->getLocationFormSchema()
			),
		];
	}

	protected function getLocationFormSchema(): array
	{
		return [
			\Filament\Forms\Components\Grid::make()->schema([
				\Filament\Forms\Components\Select::make("countryId")
					->label(__('Country'))
					->name("countryId")
					->reactive()
					->options(Country::all()->pluck("name", "id")),
				\Filament\Forms\Components\Select::make("cityId")
					->label(__('City'))
					->name("cityId")
					->reactive()
					->options(function (callable $get) {
						$countryId = $get("countryId");
						if (!$countryId) {
							return [];
						}

						$country = Country::find($countryId);

						return $country->cities->pluck("name", "id");
					}),
			]),
		];
	}

	protected function getMainFormSchema(): array
	{

		return [
			\Filament\Forms\Components\Grid::make()
				->schema([
					\Filament\Forms\Components\TextInput::make("officeName")
					->label(__('Office name')),
					\Filament\Forms\Components\Select::make("professionId")
						->label(__('Profession'))
						->options(function() {
							return Service::where('slug', $this->service->slug)->first()->professions->pluck('name', 'id');
					
						}),
					\Filament\Forms\Components\Select::make("specializationsIds")
						->label(__('Specialization'))
						->reactive()
						->multiple()
						->preload()
						->options(function (callable $get) {
							$professionId = $get("professionId");
							if (!$professionId) {
								return [];
							}
							$profession = Profession::find($professionId);
							return $profession->specializations->pluck("name", "id");
						})
				])
				->columns(3),
		];
	}

	public function render()
	{
		
		$user = auth()->user();
		$offices = DigitalOffice::where('service_id', $this->service->id)->setuped();
		
		if(!$user || !$user->can_contact_offices()) {
			$offices = $offices->noHidden();
		}

		if(!empty($this->officeName)) {
			$offices = $offices->where('name', 'like', '%'.$this->officeName. '%');
		}

		if(!empty($this->professionId)) {
			$offices = $offices->where('profession_id', $this->professionId);
		}

		if(!empty($this->specializationsIds)) {

		}

		if(setting('digital_office_hide_unsubscribed_offices') == 1) {
			$offices = $offices->subscribed();
		}

		$offices = $offices->get();

		return view("livewire.front.widgets.list-offices", ["offices" => $offices]);
	}
}
