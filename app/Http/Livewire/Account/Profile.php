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
		$citizenships = Country::all()->pluck("citizenship", "id");

		$formScheme = [
			Components\TextInput::make("national_ID")
				->label("الهوية الوطنية")
				->required(),
			Components\Select::make("gender")
				->options([
					"male" => "ذكر",
					"female" => "انثى",
				])
				->label("الجنس")
				->required(),
			Components\Select::make("original_country")
				->options($citizenships)
				->label("الجنسية"),
			Components\FileUpload::make("national_id_attachment")->label(
				"صورة الهوية"
			),
			Components\Repeater::make("experiences")
				->schema([
					Components\TextInput::make("title")->label("العنوان"),
					Components\Grid::make()
						->schema([
							Components\DatePicker::make("start_date")->label("من"),
							Components\DatePicker::make("end_date")->label("الى"),
						])
						->columns(2),
				])
				->label("الخبرات")
				->defaultItems(3)
				->itemLabel(fn(array $state): ?string => $state["title"] ?? null),
			Components\Repeater::make("education")
				->schema([
					Components\TextInput::make("title")->label("العنوان"),
					Components\Grid::make()
						->schema([
							Components\DatePicker::make("start_date")->label("من"),
							Components\DatePicker::make("end_date")->label("الى"),
						])
						->columns(2),
				])
				->label("الدارسة")
				->defaultItems(3),
		];

		if ($this->profile->isCompleted) {
			$formScheme[] = Components\Select::make("status")
				->options([
					"available" => "متوفر",
					"busy" => "مشغول",
				])
				->label("الحالة");
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
			"national_ID" => "required|string|min:4",
			"gender" => ["required", Rule::in(["male", "female"])],
			"original_country" => "nullable|int|exists:App\Models\Country,id",
		]);

		if (!$this->profile->isCompleted) {
			$redirect = true;
			$data["status"] = "available";
		}

		auth()
			->user()
			->profile->update($data);

		Notification::make()
			->title("تم تحديث المعلومات بنجاح")
			->success()
			->send();

		if ($redirect) {
			redirect()->route("account.settings");
		}
	}
}
