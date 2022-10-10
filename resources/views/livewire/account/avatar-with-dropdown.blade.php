<!-- Profile dropdown -->
<div class="relative mr-3" x-data="{ isOpen: false }">
    <div>
        <button @click="isOpen = !isOpen" type="button" class="flex max-w-xs items-center rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
            <span class="sr-only">Open user menu</span>
            <img class="h-8 w-8 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
        </button>
    </div>

    <div @click.away="isOpen = false" x-show.transition.opacity="isOpen" class="absolute right-0 z-10 mt-2 w-48 origin-top-left rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
        <div class="py-3 px-4 text-sm text-gray-900 dark:text-white border-b">
            <div>{{ $user->name }}</div>
            <div class="font-medium truncate">{{ $user->email }}</div>
        </div>
        <!-- Active: "bg-gray-100", Not Active: "" -->
        <a href="/account/profile" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-0">إعدادات الحساب</a>

        <a href="/account/balance" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-1">الرصيد: {{ $user->available_balance }} SAR</a>

        <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-2">تسجيل الخروج</a>
    </div>
</div>