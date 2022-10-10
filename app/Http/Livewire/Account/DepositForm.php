<?php

namespace App\Http\Livewire\Account;

use App\Models\Transaction;
use App\Models\Withdrawal;
use Filament\Forms\Components\FileUpload;
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
        return [
            Tabs::make('Heading')
                ->tabs([
                    Tabs\Tab::make('تحويل بنكي')
                        ->schema([
                            TextInput::make('amount')->label('المبلغ')->required(),
                            TextInput::make('txn_id')->label('رقم المعاملة المالية')->required(),
                            FileUpload::make('receipt_attachment')->label('صورة لوصل تأكيد التحويل'),
                        ])
                ])
        ];
    }

    public function save(): void
    {
        $user = auth()->user();
        $data = $this->form->getState();

        Transaction::create([
            'user_id' => $user->id,
            'amount' => $data['amount'],
            'type' => 'debit',
            'source' => 'deposit',
            'status' => 'under_review',
            'metadata' => json_encode([
                'txn_id' => $data['txn_id'],
                'receipt_attachment' => $data['receipt_attachment']
            ])
        ]);

    }

    public function submit() {
        $this->save();        
    }

    public function render()
    {
        return view('livewire.account.deposit-form');
    }
}
