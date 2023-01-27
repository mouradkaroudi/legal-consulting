<form wire:submit.prevent="submit">
   {{ $this->form }}
   <x-filament::button class="w-full mt-4" :type="'submit'" size='lg'>
    {{ __('Complete the payment') }}
   </x-filament::button>
   <p class="text-sm text-gray-700 mt-4 text-center">
      {{ __('Subscription fees do not include fees that payment providers are required.') }}
   </p>
</form>
