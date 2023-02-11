<x-filament::dropdown placement="bottom-end">

    <x-slot name="trigger">
        <button type="button" class="flex max-w-xs items-center rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
            <img class="h-8 w-8 rounded-full" src="{{ $user->avatar_url() }}" alt="">
        </button>
    </x-slot>
    <x-filament::dropdown.header>
        <div>{{ $user->name }}</div>
        <div class="font-medium truncate">{{ $user->email }}</div>

    </x-filament::dropdown.header>
    <x-filament::dropdown.list>

        <x-filament::dropdown.list.item tag="a" :href="route('account.settings')">
            {{ __('Account settings') }}
        </x-filament::dropdown.list.item>

        <x-filament::dropdown.list.item tag="a" :href="route('account.credit.index')">
            {{ __('Balance :balance', ['balance' => money($user->available_balance, 'sar', true)]) }}
        </x-filament::dropdown.list.item>

        <x-filament::dropdown.list.item tag="a" :href="route('auth.logout')">
            {{ __('Log out') }}
        </x-filament::dropdown.list.item>

    </x-filament::dropdown.list>
</x-filament::dropdown>