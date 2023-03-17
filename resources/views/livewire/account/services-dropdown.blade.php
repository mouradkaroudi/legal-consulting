<x-filament::dropdown placement="bottom-end">
    <x-slot name="trigger">
        <x-filament::button icon="heroicon-o-chevron-down" iconPosition="after" color="custom" class="bg-blue-800 p-2 text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-blue-800">
            {{ __('Services') }}
        </x-filament::button>

    </x-slot>
    <x-filament::dropdown.list>
        @foreach( $navigationLinks as $navigationLink )
        <x-filament::dropdown.list.item tag="a" :href="$navigationLink['routeName']">
            {{ $navigationLink['label'] }}
        </x-filament::dropdown.list.item>
        @endforeach
    </x-filament::dropdown.list>
</x-filament::dropdown>