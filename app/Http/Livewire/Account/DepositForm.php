<?php

namespace App\Http\Livewire\Account;

use App\Models\Transaction;
use App\Models\Withdrawal;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Livewire\Component;

class DepositForm extends Component implements HasForms
{
	use InteractsWithForms;

	public Transaction $transaction;

	public $txn_id;
	public $receipt_attachment;
	public $amount;

	protected function getFormSchema(): array
	{
		$depositMethodsTabs = [];

		if (get_option("transactions_bank_transfer") != 0) {
			$depositMethodsTabs[] = Tabs\Tab::make("تحويل بنكي")->schema([
                Placeholder::make('bank')->label('الحساب البنكي')
                ->content("قم بتحويل المبلغ الذي تريد شحن بحسابك الى الحساب البنكي " . get_option('transactions_bank_rib')),
                TextInput::make("amount")
					->label("المبلغ")
					->required(),
				TextInput::make("txn_id")
					->label("رقم المعاملة المالية")
					->required(),
				FileUpload::make("receipt_attachment")->label(
					"صورة لوصل تأكيد التحويل"
				),
			]);
		}

		return [Tabs::make("Heading")->tabs($depositMethodsTabs)];
	}

	public function save(): void
	{
		$user = auth()->user();
		$data = $this->form->getState();

		$user->transactions()->create([
			"amount" => $data["amount"],
			"type" => "debit",
			"source" => "deposit",
			"status" => Transaction::PENDING,
			"metadata" => json_encode([
				"txn_id" => $data["txn_id"],
				"receipt_attachment" => $data["receipt_attachment"],
			]),
		]);
	}

	public function submit()
	{
		$this->save();
	}

	public function render()
	{
		return view("livewire.account.deposit-form");
	}
}
