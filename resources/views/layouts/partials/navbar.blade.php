<header class="flex-shrink-0 border-b bg-white">
    <div class="flex items-center justify-between p-2 w-full mx-auto md:px-6 lg:px-8 max-w-7xl">
        <!-- Navbar left -->
        <div class="flex items-center space-x-3">
            <span class="p-2 text-xl font-semibold tracking-wider uppercase lg:hidden">
                <livewire:shared.site-logo/>
            </span>
            <!-- Toggle sidebar button -->
            <button @click="toggleSidbarMenu()" class="p-2 rounded-md focus:outline-none focus:ring">
                <svg class="w-4 h-4 text-gray-600" :class="{'transform transition-transform -rotate-180': isSidebarOpen}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                </svg>
            </button>
        </div>
        <div class="relative flex items-center space-x-3">
            <div class="items-center hidden space-x-3 space-x-reverse md:flex">
                <livewire:account.avatar-with-dropdown />
            </div>
        </div>
    </div>
</header>