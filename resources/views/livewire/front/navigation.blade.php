<nav class="bg-white border-gray-30 border-b">
    <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl px-4 md:px-6 py-2">

        <a href="{{ route('home') }}" class="flex items-center">
            <livewire:shared.site-logo />
        </a>

        <button data-collapse-toggle="mega-menu-full" type="button" class="inline-flex items-center p-2 mr-1 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200" aria-controls="mega-menu-full" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
            </svg>
        </button>

        <div id="mega-menu-full" class="hidden justify-between items-center w-full md:flex md:w-auto md:order-1">
            <ul class="flex flex-col items-center p-4 mt-4 bg-gray-50 rounded-lg border border-gray-100 md:flex-row space-x-8 space-x-reverse md:mt-0 md:border-0 md:bg-white">
                @if($menu)
                @foreach($menu as $menuItem)
                <li class="relative" x-data="{ isOpen: false }">
                    @if(!empty($menuItem['children']))
                    <div>
                        <button @click="isOpen = !isOpen" id="mega-menu-full-dropdown-button" data-collapse-toggle="mega-menu-full-dropdown" class="flex justify-between items-center py-2 pr-4 pl-3 w-full text-gray-700 rounded md:w-auto hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-600 md:p-0">
                            {{ $menuItem['label'] }}
                            <svg class="mr-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                    <div x-show="isOpen" @click.away="isOpen = false" x-show.transition.opacity="isOpen" class="absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                        <div class="py-1" role="none">
                            @foreach($menuItem['children'] as $meniChildItem)
                            <a href="{{ $meniChildItem['data'] ? $meniChildItem['data']['url'] : ''}}" class="block py-2 px-4 hover:bg-gray-100" aria-current="page">
                                {{ $meniChildItem['label'] }}
                            </a>
                            @endforeach
                        </div>
                    </div>
                    @else
                    <a href="#" class="block py-2 pr-4 pl-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0" aria-current="page">
                        {{ $menuItem['label'] }}
                    </a>
                    @endif

                </li>
                @endforeach
                @endif
                <li>
                    <livewire:account.avatar-with-dropdown />
                </li>
                <li>
                    <livewire:guest.select-language />
                </li>
            </ul>
        </div>
    </div>
</nav>