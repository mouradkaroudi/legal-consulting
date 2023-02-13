<form>
    {{ $this->form }}
    <x-filament::button class="w-full mt-4" :type="'submit'" size='lg'>
        {{ __('Complete the payment') }}
    </x-filament::button>
</form>