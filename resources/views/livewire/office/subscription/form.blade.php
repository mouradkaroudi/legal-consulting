<div>
   <div>
      <h2 class="text-xl font-bold mb-2">{{ __('Subscription plan') }}</h2>
   </div>
   <div class="mb-6">
      {{ $this->plansForm }}
   </div>

   <div>
      <h2 class="text-xl font-bold mb-2">{{ __('Payment') }}</h2>
   </div>

   <form wire:submit.prevent="submit">

      {{ $this->paymentAccountOptionsForm }}
      <x-filament::button class="w-full mt-4" :type="'submit'" size='lg'>
         {{ __('Subscribe now') }}
      </x-filament::button>

   </form>

   <div class="flex items-center my-4 before:flex-1 before:border-t before:border-gray-300 before:mt-0.5 after:flex-1 after:border-t after:border-gray-300 after:mt-0.5">
      <p class="text-center font-semibold mx-4 mb-0">
         {{ __('Or') }}
      </p>
   </div>

   <livewire:payment.form :wire:key="'payment-subscribe-' . $plan_id" :plan_id="$plan_id" />

</div>