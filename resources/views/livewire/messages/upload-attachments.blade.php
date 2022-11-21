    <x-filament::modal>
        <x-slot name="trigger">
            <x-filament::button type="button" x-on:click="isOpen = true">أرفع ملف</x-filament::button>
        </x-slot>

        <x-slot name="header">
            رفع ملفات
        </x-slot>
        
            {{ $this->form }}
            <x-filament::modal.actions alignment="right">
                <x-filament::button wire:target="uploadAttachment" type="submit">رفع</x-filament::button>
            </x-filament::modal.actions>
    </x-filament::modal>