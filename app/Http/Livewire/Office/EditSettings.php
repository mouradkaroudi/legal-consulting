<?php

namespace App\Http\Livewire\Office;

use App\Models\DigitalOffice;
use App\Models\DigitalOfficeSpecialization;
use App\Models\Profession;
use App\Models\Service;
use App\Models\Specialization;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Notifications\Notification;
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
			"image" => $this->digitalOffice->image,
			"name" =>$this->digitalOffice->name,
			"description" =>$this->digitalOffice->description,
			"phone_number" => $this->digitalOffice->phone_number,
			"professional_license_number" => $this->digitalOffice->professional_license_number,
			"municipal_license_number" => $this->digitalOffice->municipal_license_number,
			"tax_establishment_number" => $this->digitalOffice->tax_establishment_number,
			"license_attachment" => $this->digitalOffice->license_attachment,
			"status" => $this->digitalOffice->status,
			"specializations" => $this->digitalOffice->specializations->pluck('id')
		]);
	}

	protected function getFormModel(): DigitalOffice
	{
		return $this->digitalOffice;
	}

	// TODO: add TVA
	protected function getFormSchema(): array
	{

		$specializations = Specialization::where('id', $this->digitalOffice->profession_id)->with('translation')->get()->pluck('translation.name', 'id');

		$fields = [
			Forms\Components\FileUpload::make("image")
				->image()
				->imagePreviewHeight("250")
				->panelAspectRatio("16:9")
				->panelLayout("integrated")
				->label(__('Image')),
			Fieldset::make("info")
				->label(__('General information'))
				->schema([
					Grid::make(2)->schema([
						Forms\Components\TextInput::make("name")
							->label(__('Office name'))
							->minLength(4)
							->required(),
						Forms\Components\TextInput::make("phone_number")->label(
							__("validation.attributes.phone")
						),
					]),
					Forms\Components\MarkdownEditor::make("description")
						->label(__('Description')),
				])
				->columns(1),
			Select::make("specializations")
				->label(__('Select specializations'))
				//->relationship('specializations', 'id')
				->multiple()
				->options($specializations),

			Fieldset::make("licenses")
				->label(__('Licenses'))
				->schema([
					Forms\Components\TextInput::make("commercial_registration_number")
						->label(__('Commercial registre number')),
					Forms\Components\TextInput::make("professional_license_number")
						->label(__('Professional license number')),
					Forms\Components\TextInput::make("municipal_license_number")
						->label(__('Municipal license number')),
					Forms\Components\TextInput::make("tax_establishment_number")
						->label(__('Tax establishment number')),
				]),
		];

		$fields[] = Fieldset::make("attachments")
			->label(__('Attachments'))
			->schema([
				Forms\Components\FileUpload::make("license_attachment")
					->label(__('Commercial register')),
			])
			->columns(1);

		if ($this->digitalOffice->status != DigitalOffice::UNCOMPLETED) {
			$fields[] = Forms\Components\Select::make("status")
				->label(__('Status'))
				->options([
					DigitalOffice::AVAILABLE => __('Available'),
					DigitalOffice::BUSY => __('Busy'),
					DigitalOffice::CLOSED => __('Closed'),
				])
				->in([DigitalOffice::BUSY, DigitalOffice::AVAILABLE, DigitalOffice::CLOSED])
				->columns(1);
		}

		return $fields;
	}

	public function submit(): void
	{
		$this->authorize("update", $this->digitalOffice);

		$data = $this->form->getState();

		$specializationsIds = $data['specializations'];
		$specializations = [];

		foreach($specializationsIds as $specializationsId) {
			$specializations[] = [
				'specialization_id' => $specializationsId,
				'office_id' => $this->digitalOffice->id
			];
		}

		$data = [
			"image" => $data["image"],
			"description" => $data["description"],
			"phone_number" => $data["phone_number"],
			"professional_license_number" => $data["professional_license_number"],
			"municipal_license_number" => $data["municipal_license_number"],
			"tax_establishment_number" => $data["tax_establishment_number"],
			"license_attachment" => $data["license_attachment"],
			"status" => $data["status"] ?? ""
		];

		$this->digitalOffice->update($data);
		
		DigitalOfficeSpecialization::upsert($specializations, ['specialization_id', 'office_id']);

		Notification::make()
			->title(__('The information has been updated successfully'))
			->success()
			->send();
	}

	public function render()
	{
		return view("livewire.office.edit-settings");
	}
}
