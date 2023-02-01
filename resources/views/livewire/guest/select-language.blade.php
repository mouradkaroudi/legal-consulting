<x-filament::dropdown placement="bottom-end">
    <x-slot name="trigger">
        <x-filament::button color="secondary" icon="heroicon-o-translate" labelSrOnly="true" />
    </x-slot>
    <x-filament::dropdown.list>
        <x-filament::dropdown.list.item tag="a" :href="request()->url() . '?language=ar'">
            العربية
        </x-filament::dropdown.list.item>
        <x-filament::dropdown.list.item tag="a" :href="request()->url() . '?language=en'">
            English
        </x-filament::dropdown.list.item>
    </x-filament::dropdown.list>
</x-filament::dropdown>