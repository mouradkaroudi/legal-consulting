<div class="relative" x-data="{ isOpen: false }">
    <div>
        <button @click="isOpen = !isOpen" type="button" class="inline-flex items-center focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 ml-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800" aria-expanded="false" aria-haspopup="true">
            {{ $currentOffice->name }}
            <x-heroicon-o-chevron-down class="mr-2 w-4 h-4" />
        </button>
    </div>
    <div @click.away="isOpen = false" x-show.transition.opacity="isOpen" class="divide-y divide-gray-200 absolute left-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-office-select-buttonn" tabindex="-1">
        <a href="{{ route('office.settings') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1">
            {{ __('offices.dropdown.settings') }}
        </a>
        <a href="{{ route('office.balance') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1">
            {{ __('offices.dropdown.balance', ['balance' => money($currentOffice->available_balance, 'sar', true)]) }}
        </a>
        <a href="{{ route('office.balance') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1">
            {{ __('offices.dropdown.logout') }}
        </a>

    </div>
</div>