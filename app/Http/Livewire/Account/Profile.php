<?php

namespace App\Http\Livewire\Account;

use App\Models\Country;
use App\Models\Profile as ModelsProfile;
use Filament\Forms\Components;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Profile extends Component implements HasForms
{
	use InteractsWithForms;

	public ModelsProfile $profile;

	public function mount($profile)
	{
		$this->form->fill($profile->toArray());
	}

	protected function getFormSchema(): array
	{
		
		$formScheme = [

			Components\Select::make("gender")
				->label(__('validation.attributes.sex'))
				->options([
					"male" => __('Male'),
					"female" => __('Female'),
				])
				->required(),

			Components\FileUpload::make("car_license_image")
				->label(__('Vehicle License')),
			Components\TextInput::make("professional_license_number")
				->label(__('Professional license number')),
			Components\FileUpload::make("professional_license_image")
				->label(__('Professional license image')),
			Components\Repeater::make("experiences")
				->schema([
					Components\TextInput::make("title")
						->label(__('validation.attributes.title')),
					Components\Grid::make()
						->schema([
							Components\DatePicker::make("start_date")
								->label(__('validation.attributes.from')),
							Components\DatePicker::make("end_date")
								->label(__('validation.attributes.to')),
						])
						->columns(2),
				])
				->label(__('validation.attributes.experience'))
				->defaultItems(3)
				->itemLabel(fn (array $state): ?string => $state["title"] ?? null),
			Components\Repeater::make("education")
				->schema([
					Components\TextInput::make("title")
						->label(__('validation.attributes.title')),
					Components\Grid::make()
						->schema([
							Components\DatePicker::make("start_date")
								->label(__('validation.attributes.from')),
							Components\DatePicker::make("end_date")
								->label(__('validation.attributes.to')),
						])
						->columns(2),
				])

				->label(__('validation.attributes.education'))
				->defaultItems(3),
		];

		if ($this->profile->isCompleted) {
			$formScheme[] = Components\Select::make("status")
				->label(__('validation.attributes.status'))
				->options([
					"available" => __("Available"),
					"busy" => __('Busy'),
				]);
		}

		return $formScheme;
	}

	public function render()
	{
		return view("livewire.account.profile");
	}

	public function submit()
	{
		$redirect = false;

		$data = $this->validate([
			"gender" => ["required", Rule::in(["male", "female"])],
		]);

		if (!$this->profile->isCompleted) {
			$redirect = true;
			$data["status"] = "available";
		}

		auth()
			->user()
			->profile->update($data);

		Notification::make()
			->title(__('The information has been updated successfully'))
			->success()
			->send();

		if ($redirect) {
			redirect()->route("account.settings");
		}
	}
}
