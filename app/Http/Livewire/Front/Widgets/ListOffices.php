<?php

namespace App\Http\Livewire\Front\Widgets;

use App\Models\DigitalOffice;
use App\Models\Country;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Livewire\Component;

class ListOffices extends Component implements HasForms
{
	use InteractsWithForms;

    public $officeName;
	public $countryId;
	public $cityId;
	public $professionId;
	public $specializationId;
    
    protected $queryString = ['officeName'];

	protected function getForms(): array
	{
		return [
			"mainForm" => $this->makeForm()->schema($this->getMainFormSchema()),
			"locationForm" => $this->makeForm()->schema(
				$this->getLocationFormSchema()
			),
		];
	}

	public function submit()
	{

	}

	protected function getLocationFormSchema(): array
	{
		return [
			\Filament\Forms\Components\Grid::make()->schema([
				\Filament\Forms\Components\Select::make("countryId")
					->label("الدولة")
					->name("countryId")
					->reactive()
					->options(Country::all()->pluck("name", "id")),
				\Filament\Forms\Components\Select::make("cityId")
					->label("المدينة")
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
					\Filament\Forms\Components\TextInput::make("officeName")->label(
						"اسم المكتب"
					),
					\Filament\Forms\Components\Select::make("professionId")
						->label("المهنة")
						->name("professionId"),
					\Filament\Forms\Components\Select::make("specializationId")
						->label("التخصص")
						->name("specializationId"),
				])
				->columns(3),
		];
	}

	public function render()
	{
		$offices = DigitalOffice::available()->get();
		return view("livewire.front.widgets.list-offices", ["offices" => $offices]);
	}
}
