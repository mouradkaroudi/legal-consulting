<nav class="bg-white border-gray-30 border-b">
    <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl px-4 md:px-6 py-2">

        <a href="{{ route('home') }}" class="flex items-center">
            <livewire:shared.site-logo />
        </a>
        <div class="hidden md:flex md:gap-6 justify-between items-center">
            @if($menu)
            @foreach($menu as $menuItem)
            @if(!empty($menuItem['children']))
            <x-filament::dropdown placement="bottom-end">
                <x-slot name="trigger">
                    <a href="#" class="flex items-center gap-2 py-2 pr-4 pl-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0">
                        {{ $menuItem['label'] }}
                        <x-heroicon-o-chevron-down class="block h-4 w-4" />
                    </a>
                </x-slot>
                <x-filament::dropdown.list>
                    @foreach($menuItem['children'] as $meniChildItem)
                    <x-filament::dropdown.list.item tag="a" :href="$meniChildItem['data'] ? $meniChildItem['data']['url'] : ''">
                        {{ $meniChildItem['label'] }}
                    </x-filament::dropdown.list.item>
                    @endforeach
                </x-filament::dropdown.list>
            </x-filament::dropdown>
            @else
            <a href="{{ $menuItem['data'] ? $menuItem['data']['url'] : ''}}" class="block py-2 pr-4 pl-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0">
                {{ $menuItem['label'] }}
            </a>
            @endif
            @endforeach
            @endif
        </div>

        <div id="mega-menu-full" class="flex justify-between items-center w-auto">
            <ul class="flex items-center p-4 space-x-4 rtl:space-x-reverse">
                <li>
                    <x-filament::dropdown placement="bottom-end">
                        <x-slot name="trigger">
                            <button type="button" class="block md:hidden p-2 text-gray-500 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
                                <span class="sr-only">Open main menu</span>
                                <x-heroicon-o-menu class="block h-6 w-6" />
                            </button>
                        </x-slot>
                        <x-filament::dropdown.list>
                            @if($menu)
                            @foreach($menu as $menuItem)
                            @if(!empty($menuItem['children']))
                            <x-filament::dropdown placement="bottom-end">
                                <x-slot name="trigger">
                                    <x-filament::dropdown.list.item :href="$menuItem['data'] ? $menuItem['data']['url'] : ''">
                                        {{ $menuItem['label'] }}
                                    </x-filament::dropdown.list.item>
                                </x-slot>
                                <x-filament::dropdown.list>
                                    @foreach($menuItem['children'] as $meniChildItem)
                                    <x-filament::dropdown.list.item tag="a" :href="$meniChildItem['data'] ? $meniChildItem['data']['url'] : ''">
                                        {{ $meniChildItem['label'] }}
                                    </x-filament::dropdown.list.item>
                                    @endforeach
                                </x-filament::dropdown.list>
                            </x-filament::dropdown>
                            @else
                            <x-filament::dropdown.list.item tag="a" :href="$menuItem['data'] ? $menuItem['data']['url'] : ''">
                                {{ $menuItem['label'] }}
                            </x-filament::dropdown.list.item>
                            @endif
                            @endforeach
                            @endif
                        </x-filament::dropdown.list>
                    </x-filament::dropdown>
                </li>
                <li>
                    @auth
                    <livewire:account.avatar-with-dropdown />
                    @endauth
                    @guest
                    <x-filament-support::button tag='a' :href="route('auth.login')" color="primary" icon='heroicon-o-user'>
                        {{ __('Account') }}
                    </x-filament-support::button>
                    @endguest
                </li>
                @guest
                <li>
                    <livewire:guest.select-language />
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>