<?php

namespace App\Http\Livewire\Office\Settings;

use App\Models\ProfessionSubscriptionPlan;
use App\Services\SubscriptionService;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Livewire\Component;
use Suleymanozev\FilamentRadioButtonField\Forms\Components\RadioButton;

class Subscription extends Component implements HasForms
{

    use InteractsWithForms;

    public $digitalOffice;
    public $expirationDuration = null;
    public $plan_id;

    public function submit() {
        return redirect()->route('office.subscription.index', ['profession_subscription_plan' => $this->plan_id]);
    }

    public function mount()
    {
        
        $subscription = $this->digitalOffice->subscription;

        if( empty($subscription) ) {
            return;
        }

        if( SubscriptionService::isSubscriptionExpireAfter( $subscription, 3 ) ) {
            $this->expirationDuration = 3;
        }

    }

    public function render()
    {
        return view('livewire.office.settings.subscription');
    }
}
