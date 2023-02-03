<x-filament::dropdown>
    <x-slot name="trigger">
        <x-filament::button icon="heroicon-o-chevron-down" iconPosition="after" color="custom" class="bg-green-600 hover:bg-green-500 focus:bg-green-700 focus:ring-offset-green-70 rounded-full">
            {{ __('Select an office') }}
        </x-filament::button>
    </x-slot>

    <x-filament::dropdown.list>
        @foreach($offices as $office)
        <x-switch-able-office :office="$office">
            {{ $office->name }}
        </x-switch-able-office>
        @endforeach
    </x-filament::dropdown.list>

</x-filament::dropdown>