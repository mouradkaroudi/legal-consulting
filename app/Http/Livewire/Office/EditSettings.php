<?php

namespace App\Http\Livewire\Office;

use App\Models\Category;
use App\Models\DigitalOffice;
use App\Models\Profession;
use App\Models\Service;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
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
		$this->form->fill($this->digitalOffice->toArray());
	}
	// TODO: add TVA
	protected function getFormSchema(): array
	{
		$fields = [
			Forms\Components\FileUpload::make("image")
				->image()
				->imagePreviewHeight("250")
				->panelAspectRatio("16:9")
				->panelLayout("integrated")
				->label("صورة"),
			Fieldset::make("info")
				->schema([
					Grid::make(2)->schema([
						Forms\Components\TextInput::make("name")
							->label("اسم المكتب")
							->required(),
						Forms\Components\TextInput::make("phone_number")->label(
							__("validation.attributes.phone")
						),
					]),
					Forms\Components\MarkdownEditor::make("description")->label("وصف"),
				])
				->columns(1)
				->label("معلومات عامة"),
			Fieldset::make("categorization")
				->schema([
					Grid::make(2)
						->schema([
							Select::make("service_id")
								->label("اختر الخدمة")
								->relationship("service", "name")
								->reactive()
								->preload()
								->required(),
							Select::make("profession_id")
								->label("اختر المهنة")
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
						])
						->label("التصنيف"),
					Select::make("specializations")
						->label("اختر التخصصات")
						->relationship("specializations", "name")
						->multiple()
						->options(function (callable $get) {
							$professionId = $get("profession_id");

							if (!$professionId) {
								return [];
							}

							$profession = Profession::find($professionId);
							return $profession->specializations->pluck("name", "id");
						})
						->preload()
						->reactive(),
				])
				->columns(1)
				->label("التصنيف"),
			Fieldset::make("licenses")
				->schema([
					Forms\Components\TextInput::make("commercial_registration_number")
						->label("رقم سجل التجاري")
						->required(),
					Forms\Components\TextInput::make(
						"professional_license_number"
					)->label("رقم الرخصة المهنية"),
					Forms\Components\TextInput::make("municipal_license_number")->label(
						"رقم رخصة البلدية"
					),
					Forms\Components\TextInput::make("tax_establishment_number")->label(
						"رقم المنشأة الضريبي"
					),
				])
				->label("التراخيص"),
		];

		$fields[] = Fieldset::make("attachments")
			->schema([
				Forms\Components\FileUpload::make("license_attachment")->label(
					"مرفق للسجل التجاري"
				),
			])
			->columns(1)
			->label("المرفقات");

		if ($this->digitalOffice->status != "uncomplete") {
			$fields[] = Forms\Components\Select::make("status")
				->label("الحالة")
				->options([
					"busy" => "مشغول",
					"available" => "متوفر",
				])
				->columns(1);
		}

		return $fields;
	}

	public function submit(): void
	{
		$this->authorize("update", $this->digitalOffice);

		$validatedData = $this->validate([
			"name" => "required|string|min:6",
			"service_id" => ["required", "exists:App\Models\Service,id"],
			"profession_id" => ["required", "exists:App\Models\Profession,id"],
			"commercial_registration_number" => "required|min:4",
		]);

		$data = $this->form->getState();

		$data = array_merge($validatedData, [
			"image" => $data["image"],
			"description" => $data["description"],
			"phone_number" => $data["phone_number"],
			"professional_license_number" => $data["professional_license_number"],
			"municipal_license_number" => $data["municipal_license_number"],
			"tax_establishment_number" => $data["tax_establishment_number"],
			"license_attachment" => $data["license_attachment"],
			"status" => $data["status"] ?? ""
		]);

		$redirect = false;

		$currentStatus = $this->digitalOffice->status;

		if ($currentStatus == "uncomplete") {
			$data["status"] = "available";
			$redirect = true;
		} elseif (in_array($data["status"], ["busy", "available"])) {
			$data["status"] = $data["status"];
		} else {
			$data["status"] = $currentStatus;
		}

		$this->digitalOffice->update($data);

		Notification::make()
			->title("تم تحديث المعلومات بنجاح")
			->success()
			->send();
		
		if($redirect) {
			redirect()->route('office.settings', $this->digitalOffice);
		}

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
