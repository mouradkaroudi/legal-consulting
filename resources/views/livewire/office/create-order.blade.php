<form wire:submit.prevent="submit">
    <x-filament::modal id="create-order-modal">
        <x-slot name="trigger">
            <x-filament::button type="button" x-on:click="isOpen = true">أنشئ فاتورة</x-filament::button>
        </x-slot>

        <x-slot name="header">
            أنشئ فاتورة
        </x-slot>
        
            {{ $this->form }}
            <x-filament::modal.actions alignment="right">
                <x-filament::button wire:target="submit" :type="'submit'">أنشئ الطلب</x-filament::button>
            </x-filament::modal.actions>
    </x-filament::modal>
</form>