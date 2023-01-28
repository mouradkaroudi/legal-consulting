<!-- Sidebar backdrop -->
<div x-show.in.out.opacity="isSidebarOpen" class="fixed inset-0 z-10 bg-black bg-opacity-20 lg:hidden" style="backdrop-filter: blur(14px); -webkit-backdrop-filter: blur(14px)"></div>

<!-- Sidebar -->
<aside 
    x-cloak 
    x-transition:enter="transition transform duration-300" 
    x-transition:enter-start="translate-x-full opacity-30 ease-in" 
    x-transition:enter-end="translate-x-0 opacity-100 ease-out" 
    x-transition:leave="transition transform duration-300" 
    x-transition:leave-start="translate-x-0 opacity-100 ease-out" 
    x-transition:leave-end="translate-x-full opacity-0 ease-in" 
    class="fixed inset-y-0 z-10 flex flex-col flex-shrink-0 w-64 max-h-screen transition-all transform bg-white border-l shadow-2xl lg:z-auto lg:static" :class="{'-translate-x-full rtl:translate-x-full lg:-translate-x-0 rtl:lg:translate-x-0 lg:w-20': !isSidebarOpen}">
    <!-- sidebar header -->
    <div class="flex items-center justify-between flex-shrink-0 px-3 border-b h-14 " :class="{'lg:justify-center': !isSidebarOpen}">
        <livewire:shared.site-logo />
        <button @click="toggleSidbarMenu()" class="p-2 rounded-md lg:hidden">
            <svg class="w-6 h-6 text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
    <!-- Sidebar links -->
    <nav class="flex-1 overflow-hidden hover:overflow-y-auto">
        <ul class="space-y-2 p-3">
            @foreach( $sidebarLinks as $sidebarLink )
            <li>
                <a 
                    href="{{ route($sidebarLink['routeName'], ['digitalOffice' => $officeId]) }}" 
                    class="{{ (strpos(Route::currentRouteName(), $sidebarLink['routeName']) === 0) ? 'text-white bg-green-700 hover:bg-green-800 font-semibold' : 'text-gray-900 hover:bg-gray-100' }} flex items-center p-2 text-base rounded-lg"
                    :class="{'justify-center': !isSidebarOpen}"
                >
                    @if(isset($sidebarLink['icon']) && !empty($sidebarLink['icon']))
                        <x-dynamic-component :component="$sidebarLink['icon']" class="w-6 h-6" />
                    @endif
                    <span :class="{ 'lg:hidden': !isSidebarOpen }" class="flex-1 ml-3 rtl:mr-3 whitespace-nowrap">{{ $sidebarLink['label'] }}</span>
                    @if(isset($sidebarLink['badge']) && !empty($sidebarLink['badge']))
                        <span class="inline-flex justify-center items-center p-3 mr-3 w-3 h-3 text-sm font-medium text-blue-600 bg-blue-200 rounded-full">
                            {{ $sidebarLink['badge'] }}
                        </span>
                    @endif
                </a>
            </li>
            @endforeach
            <!-- Sidebar Links... -->
        </ul>
    </nav>
</aside>