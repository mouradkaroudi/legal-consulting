<?php

namespace App\Http\Livewire\Office\Settings;

use App\Services\SubscriptionService;
use Livewire\Component;

class Subscription extends Component
{

    public $digitalOffice;
    public $expirationDuration = null;

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
