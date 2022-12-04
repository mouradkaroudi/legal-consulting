<?php

namespace App\Http\Livewire\Office;

use App\Models\Order;
use App\Models\User;
use App\Notifications\OrderCreatedNotification;
use App\Services\OrderService;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification as FacadesNotification;
use Livewire\Component;

class CreateOrder extends Component implements HasForms
{

    use InteractsWithForms, AuthorizesRequests;

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
        
        $this->authorize('create', Order::class);

        $data = $this->form->getState();

        $subject = $data['subject'];
        $fee = $data['fee'];

        OrderService::createOrder($subject, $this->beneficiaryId, $this->officeId, $fee);

    }

}
