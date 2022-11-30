<?php

namespace App\Http\Livewire\Office;

use App\Models\Order;
use App\Models\User;
use App\Notifications\OrderCreatedNotification;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification as FacadesNotification;
use Livewire\Component;

class CreateOrder extends Component implements HasForms
{

    use InteractsWithForms;

    public $officeId;
    public $beneficiaryId;
    public $subject;
    public $fee;

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('subject')->label('الموضوع')->helperText('الخدمة المقدمة (مثال : استشارة قانونية)')->required(),
            TextInput::make('fee')->label('التكلفة')->helperText('أدخل المتسحقات التي يجب على المستفيد دفعها (مثال :  1000 ريال سعدوي)')->required(),
            
        ];
    }

    public function render()
    {
        return view('livewire.office.create-order');
    }

    public function submit() {

        $data = $this->form->getState();

        $subject = $data['subject'];
        $fee = $data['fee'];

        $order = Order::create([
            'office_id' => $this->officeId,
            'beneficiary_id' => $this->beneficiaryId,
            'subject' => $subject,
            'fee' => $fee,
            'status' => 'unpaid'
        ]);

        FacadesNotification::send( User::find($this->beneficiaryId), new OrderCreatedNotification($order) );

    }

}
