<header class="flex-shrink-0 border-b bg-white">
    <div class="flex items-center justify-between p-2">
        <!-- Navbar left -->
        <div class="flex items-center space-x-3">
            <span class="p-2 text-xl font-semibold tracking-wider uppercase lg:hidden">K-WD</span>
            <!-- Toggle sidebar button -->
            <button @click="toggleSidbarMenu()" class="p-2 rounded-md focus:outline-none focus:ring">
                <svg class="w-4 h-4 text-gray-600" :class="{'transform transition-transform -rotate-180': isSidebarOpen}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                </svg>
            </button>
        </div>

        
        <div class="relative flex items-center space-x-3">
            <div class="items-center hidden space-x-3 space-x-reverse md:flex">
                <div class="relative" x-data="{ isOpen: false }">
                    
                    <div class="absolute left-0 p-1 bg-red-400 rounded-full animate-ping"></div>
                    <div class="absolute left-0 p-1 bg-red-400 border rounded-full"></div>
                    <button @click="isOpen = !isOpen" class="p-2 bg-gray-100 rounded-full hover:bg-gray-200 focus:outline-none focus:ring">
                        <svg class="w-6 h-6 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                    </button>

                    <div @click.away="isOpen = false" x-show.transition.opacity="isOpen" class="absolute w-48 max-w-md mt-3 transform bg-white rounded-md shadow-lg translate-x-3/4 min-w-max">
                        <div class="p-4 font-medium border-b">
                            <span class="text-gray-800">الإشعارات</span>
                        </div>
                        <ul class="flex flex-col p-2 my-2 space-y-1">
                            <li>
                                <a href="#" class="block px-2 py-1 transition rounded-md hover:bg-gray-100">تم الموافقة على شحن الرصيد</a>
                            </li>
                        </ul>
                        <div class="flex items-center justify-center p-4 text-blue-700 underline border-t">
                            <a href="#">عرض الكل</a>
                        </div>
                    </div>
                </div>

                <div class="relative" x-data="{ isOpen: false }">
                    <button @click="isOpen = !isOpen" class="p-2 bg-gray-100 rounded-full hover:bg-gray-200 focus:outline-none focus:ring">
                        <svg class="w-6 h-6 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                        </svg>
                    </button>

                    <div @click.away="isOpen = false" x-show.transition.opacity="isOpen" class="absolute w-40 max-w-sm mt-3 transform bg-white rounded-md shadow-lg translate-x-3/4 min-w-max">
                        <ul class="flex flex-col p-2 my-2 space-y-1">
                            <li>
                                <a href="#" class="block px-2 py-1 transition rounded-md hover:bg-gray-100">إعدادات الحساب</a>
                            </li>
                            <li>
                                <a href="#" class="block px-2 py-1 transition rounded-md hover:bg-gray-100">الرصيد</a>
                            </li>
                            <li>
                                <a href="#" class="block px-2 py-1 transition rounded-md hover:bg-gray-100">تسجيل الخروج</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>