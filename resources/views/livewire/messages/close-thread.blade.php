<x-filament::modal>
    <x-slot name="trigger">
        <x-filament::button :color="'secondary'" :type="'button'" x-on:click="isOpen = true">{{ __('Close the conversation') }}</x-filament::button>
    </x-slot>

    <x-slot name="header">
        {{ __('Close the conversation') }}
    </x-slot>
    <x-alert>
        لا يمكن التراجع عن هذا الإجراء.
        هل تريد الإكمال ؟
    </x-alert>
    <x-filament::modal.actions alignment="right">
        <x-filament::button wire:click="close" :color="'danger'" :type="'button'">{{ __('Yes') }}</x-filament::button>
        <x-filament::button :color="'secondary'" x-on:click="isOpen = false" :type="'button'">{{ 'No' }}</x-filament::button>
    </x-filament::modal.actions>

</x-filament::modal>