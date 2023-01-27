<form wire:submit.prevent="submit">
    <x-filament::modal id="create-order-modal">
        <x-slot name="trigger">
            <x-filament::button type="button" x-on:click="isOpen = true">{{ __('Create an invoice') }}</x-filament::button>
        </x-slot>

        <x-slot name="header">
            {{ __('Create an invoice') }}
        </x-slot>

        {{ $this->form }}
        <x-filament::modal.actions alignment="right">
            <x-filament::button wire:target="submit" :type="'submit'">{{ __('Create the invoice') }}</x-filament::button>
        </x-filament::modal.actions>
    </x-filament::modal>
</form>