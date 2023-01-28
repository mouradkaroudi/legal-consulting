<?php

namespace App\Http\Livewire\Office;

use App\Models\Order;
use App\Services\OrderService;
use Filament\Forms\Components\Concerns\CanBeValidated;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification as NotificationsNotification;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class CreateOrder extends Component implements HasForms
{

    use InteractsWithForms, AuthorizesRequests, CanBeValidated;

    public $officeId;
    public $beneficiaryId;
    public $subject;
    public $fee;

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('subject')
                ->label(__('Subject'))
                ->helperText(__('The service you will provide, e.g., legal consultation.'))
                ->required(),
            TextInput::make('fee')
                ->label(__('Amount'))
                ->helperText(__('The amount that the beneficiary must pay, e.g., 1000 SAR.'))
                ->required(),
        ];
    }

    public function render()
    {
        return view('livewire.office.create-order');
    }

    public function submit()
    {

        $this->authorize('create', Order::class);

        OrderService::createOrder($this->subject, $this->beneficiaryId, $this->officeId, $this->fee);

        $this->dispatchBrowserEvent('close-modal', ['id' => 'create-order-modal']);
        NotificationsNotification::make()
            ->title(__('The order was created successfully'))
            ->success()
            ->send();
    }
}
