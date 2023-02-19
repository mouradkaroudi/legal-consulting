<?php

namespace App\Http\Livewire\Payment;

use App\Models\Transaction;
use App\Models\Withdrawal;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Livewire\Component;

class BankTransferForm extends Component implements HasForms
{
	use InteractsWithForms;

	public $txn_id;
	public $receipt_attachment;
	public $amount;

	protected function getFormSchema(): array
	{
		return [
			TextInput::make("amount")
				->label("المبلغ")
				->required(),
			TextInput::make("txn_id")
				->label("رقم المعاملة المالية")
				->required(),
			FileUpload::make("receipt_attachment")->label(
				"صورة لوصل تأكيد التحويل"
			),
		];
	}

	public function save(): void
	{
		$user = auth()->user();
		$data = $this->form->getState();

		$user->transactions()->create([
			"amount" => $data["amount"],
			"type" => "debit",
			"source" => Transaction::DEPOSIT,
			"status" => Transaction::PENDING,
			"metadata" => [
				"txn_id" => $data["txn_id"],
				"receipt_attachment" => $data["receipt_attachment"],
			],
		]);
	}

	public function submit()
	{
		$this->save();

		Notification::make()
			->title("تم ارسال طلب الشحن بنجاح")
			->body('سيتم اضافة الرصيد الى حسابك فور تحقق ادارة الموقع من التحويل البنكي. شكرا على تفهمك')
			->success()
			->send();

		$this->reset();
	}

	public function render()
	{
		return view("livewire.payment.bank-transfer-form");
	}
}
