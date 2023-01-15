<form wire:submit.prevent="submit">
   {{ $this->form }}
   <x-filament::button class="w-full mt-4" :type="'submit'" size='lg'>
    أكمل إلى الدفع
   </x-filament::button>
   <p class="text-sm text-gray-700 mt-4 text-center">
      رسوم الإشتراك لا تشمل رسوم التي يقتعطها مزودي خدمات الدفع.
   </p>
</form>
