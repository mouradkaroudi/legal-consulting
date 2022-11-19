<?php

namespace App\Http\Livewire\Office;

use App\Models\Category;
use App\Models\DigitalOffice;
use App\Models\Profession;
use App\Models\Service;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class EditSettings extends Component implements Forms\Contracts\HasForms
{
	use Forms\Concerns\InteractsWithForms;
	use AuthorizesRequests;

	public $digitalOffice;

	public function mount(): void
	{
		$this->form->fill([
			"name" => $this->digitalOffice["name"],
			"description" => $this->digitalOffice["description"],
			"image" => $this->digitalOffice["image"],
			"phone_number" => $this->digitalOffice["phone_number"],
			"license_number" => $this->digitalOffice["license_number"],
			"license_attachment" => $this->digitalOffice["license_attachment"],
			"country_code" => $this->digitalOffice["country_code"],
			"city" => $this->digitalOffice["city"],
			"status" => $this->digitalOffice["status"],
		]);
	}

	protected function getFormSchema(): array
	{
		$categories = Category::all();
		$options = [];

		foreach ($categories as $category) {
			$options[$category->id] = $category->name;
		}

		$fields = [
			Grid::make(2)->schema([
				Forms\Components\TextInput::make("name")
					->label("اسم المكتب")
					->required(),
				Forms\Components\TextInput::make("phone_number")
					->label(__("validation.attributes.phone"))
					->required(),
			]),
			Grid::make(2)->schema([
				Forms\Components\TextInput::make("license_number")
					->label("رقم الرخصة")
					->required(),
				Forms\Components\FileUpload::make("license_attachment")->label(
					"الرخصة"
				),
			]),
			Select::make("serviceId")
                ->label('اختر الخدمة')
				->relationship("service", "name")
				->reactive()
				->preload(),
			Select::make("professionId")
                ->label('اختر المهنة')
				->relationship("profession", "name")
				->reactive()
                ->options(function( callable $get ) {
                    $serviceId = $get('serviceId');

                    if(!$serviceId) {
                        return [];
                    }

                    $service = Service::find($serviceId);
                    return $service->professions->pluck('name', 'id');
                })
                ,
			Select::make("specializations")
                ->label('اختر التخصصات')
				->relationship("specializations", "name")
                ->multiple()
                ->options(function( callable $get ) {
                    $professionId = $get('professionId');

                    if(!$professionId) {
                        return [];
                    }

                    $profession = Profession::find($professionId);
                    return $profession->specializations->pluck('name', 'id');
                })
                ->preload()
				->reactive(),
			Grid::make(2)->schema([
				Forms\Components\FileUpload::make("image")->label("صورة"),
			]),
			Forms\Components\MarkdownEditor::make("description")->label("وصف"),
		];

		if ($this->digitalOffice->status != "uncomplete") {
			$fields[] = Grid::make(2)->schema([
				Forms\Components\Select::make("status")
					->label("الحالة")
					->options([
						"busy" => "مشغول",
						"available" => "متوفر",
					]),
			]);
		}

		return $fields;
	}

	public function save(): void
	{
	}

	public function submit(): void
	{
		$this->authorize("update", $this->digitalOffice);

		$data = $this->form->getState();
		$currentStatus = $this->digitalOffice->status;

		//TODO: add approirate logic to update status
		if ($currentStatus == "uncomplete") {
			$status = "available";
		} elseif (in_array($data["status"], ["busy", "available"])) {
			$status = $data["status"];
		} else {
			$data["status"] = $currentStatus;
		}

		$this->digitalOffice->update([
			"name" => $data["name"],
			"license_number" => $data["license_number"],
			"license_attachment" => $data["license_attachment"],
			"image" => $data["image"],
			"phone_number" => $data["phone_number"],
			"description" => $data["description"],
			"status" => $status,
		]);

		Notification::make()
			->title("تم تحديث المعلومات بنجاح")
			->success()
			->send();
	}

	protected function getFormModel(): DigitalOffice
	{
		return $this->digitalOffice;
	}

	public function render()
	{
		return view("livewire.office.edit-settings");
	}
}
