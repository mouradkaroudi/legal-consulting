@if(!empty($user))
<!-- Profile dropdown -->
<div class="relative" x-data="{ isOpen: false }">
    <div>
        <button @click="isOpen = !isOpen" type="button" class="flex max-w-xs items-center rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
            <span class="sr-only">Open user menu</span>
            <img class="h-8 w-8 rounded-full" src="{{ $user->avatar_url() }}" alt="">
        </button>
    </div>
    <div @click.away="isOpen = false" x-show.transition.opacity="isOpen" class="absolute left-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
        <div class="py-3 px-4 text-sm text-gray-900 dark:text-white border-b">
            <div>{{ $user->name }}</div>
            <div class="font-medium truncate">{{ $user->email }}</div>
        </div>
        <!-- Active: "bg-gray-100", Not Active: "" -->
        <a href="{{ route('account.settings') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1" id="user-menu-item-0">إعدادات الحساب</a>

        <a href="{{ route('account.balance') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1" id="user-menu-item-1">الرصيد: {{ $user->available_balance ?? "0.00" }} SAR</a>

        <a href="{{ route('auth.logout') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1" id="user-menu-item-2">تسجيل الخروج</a>
    </div>
</div>
@else
<a href="{{ route('auth.login') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
    </svg>
</a>
@endif