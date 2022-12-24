    <x-filament::modal>
        <x-slot name="trigger">
            <x-filament::button :color="'secondary'" :type="'button'" x-on:click="isOpen = true">غلق المحادثة</x-filament::button>
        </x-slot>

        <x-slot name="header">
            غلق المحادثة
        </x-slot>
        <x-alert>
        لا يمكن التراجع عن هذا الإجراء.
        هل تريد الإكمال ؟
        </x-alert>
        <x-filament::modal.actions alignment="right">
            <x-filament::button wire:click="close" :color="'danger'" :type="'button'">نعم</x-filament::button>
            <x-filament::button :color="'secondary'" x-on:click="isOpen = false" :type="'button'">لا</x-filament::button>
        </x-filament::modal.actions>

    </x-filament::modal>
