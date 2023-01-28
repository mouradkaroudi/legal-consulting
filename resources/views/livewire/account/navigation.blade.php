<nav class="bg-gray-800">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            <div class="flex items-center">
                <div class="text-white">
                    <a href="{{ url('/') }}">
                        <livewire:shared.site-logo />
                    </a>
                </div>
            </div>
            <div class="flex gap-2">
                @if($show_office_link)
                <livewire:account.select-office-dropdown />
                @endif
                <livewire:account.avatar-with-dropdown />
            </div>
        </div>
    </div>
</nav>

<div class="bg-gray-700 py-3">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex gap-2 items-center justify-between">
            <div class="hidden md:flex items-baseline space-x-2 rtl:space-x-reverse">
                @foreach( $navigationLinks as $navigationLink )
                <a href="{{ route($navigationLink['routeName']) }}" class="block rounded-full px-4 py-2 text-base {{ (strpos(Route::currentRouteName(), $navigationLink['routeName']) === 0) ? 'text-white bg-green-700 hover:bg-green-500' : 'text-gray-300 hover:bg-gray-900 hover:text-white' }}">
                    {{ $navigationLink['label'] }}
                </a>
                @endforeach
            </div>
            <div class="flex justify-between items-center md:w-auto w-full">
                <div class="-mr-2 flex md:hidden">
                    <x-filament::dropdown placement="bottom-end">
                        <x-slot name="trigger">
                            <button type="button" class="inline-flex items-center justify-center rounded-md bg-gray-800 p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" aria-controls="mobile-menu" aria-expanded="false">
                                <span class="sr-only">Open main menu</span>
                                <x-heroicon-o-menu class="block h-6 w-6" />
                            </button>
                        </x-slot>
                        <x-filament::dropdown.list>
                            @foreach( $navigationLinks as $navigationLink )
                            <x-filament::dropdown.list.item tag="a" :href="route($navigationLink['routeName'])">
                                {{ $navigationLink['label'] }}
                            </x-filament::dropdown.list.item>
                            @endforeach
                        </x-filament::dropdown.list>
                    </x-filament::dropdown>
                </div>
                <div class="flex gap-2">
                    <livewire:account.messages-button-with-indicator />
                    <livewire:account.notification-button />
                </div>
            </div>
        </div>
    </div>
</div>