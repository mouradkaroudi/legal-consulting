<x-filament::dropdown placement="bottom-end">
    <x-slot name="trigger">
        <x-filament::button 
            icon="heroicon-o-chevron-down" 
            iconPosition="after" 
            color="custom" 
            class="bg-green-600 hover:bg-green-500 focus:bg-green-700 focus:ring-offset-green-70 rounded-full whitespace-nowrap">
            {{ $currentOffice->name }}
        </x-filament::button>
    </x-slot>
    <x-filament::dropdown.list>

        @if(auth()->user()->hasOfficePermission($currentOffice, 'manage-office'))
        <x-filament::dropdown.list.item tag="a" :href="route('office.settings')">
            {{ __('Office settings') }}
        </x-filament::dropdown.list.item>
        <x-filament::dropdown.list.item tag="a" :href="route('office.credit.index')">
            {{ __('Balance :balance', ['balance' => money($currentOffice->available_balance, 'sar', true)]) }}
        </x-filament::dropdown.list.item>
        @endif

        <x-filament::dropdown.list.item tag="a" :href="route('office.logout')">
            {{ __('Logout') }}
        </x-filament::dropdown.list.item>

    </x-filament::dropdown.list>
</x-filament::dropdown>