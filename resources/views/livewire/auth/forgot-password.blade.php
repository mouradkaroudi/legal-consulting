<form wire:submit.prevent="submit" class="space-y-8">
    {{ $this->form }}
    <x-filament-support::button :form="'submit'" :type="'submit'" class="w-full">
        {{ __('Send') }}
    </x-filament-support::button>
    <!--  -->
</form>