<!DOCTYPE html>
<html dir="rtl" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">

    <meta name="application-name" content="{{ config('app.name') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic:wght@400;600;700&display=swap" rel="stylesheet">

    <title>{{ config('app.name') }}</title>

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    @livewireScripts
    @stack('scripts')
</head>

<body class="antialiased">
    <div>
        <div class="flex h-screen overflow-y-hidden bg-white" x-data="setup()" x-init="$refs.loading.classList.add('hidden')">
            <!-- Loading screen -->
            <div x-ref="loading" class="fixed inset-0 z-50 flex items-center justify-center text-white bg-black bg-opacity-50" style="backdrop-filter: blur(14px); -webkit-backdrop-filter: blur(14px)">
                Loading...
            </div>

            <!-- Sidebar -->
            @include('layouts.partials.sidebar')
            <div class="flex flex-col flex-1 h-full overflow-hidden bg-gray-100">
                <!-- Navbar -->
                @include('layouts.partials.navbar')
                <!-- Main content -->
                <main class="flex-1 max-h-full overflow-hidden overflow-y-scroll">
                    <!-- Main content header -->
                    <div class="w-full p-4 mx-auto md:px-6 lg:px-8 max-w-7xl">
                        <livewire:office.alerts />

                        <div class="mb-6">
                            <h1 class="text-3xl font-bold tracking-tight text-gray-900">{{ $pageTitle }}</h1>
                        </div>
                        @yield('content')
                    </div>
                </main>
                @include('layouts.partials.footer')
            </div>

            <!-- Settings panel -->
            <div x-show="isSettingsPanelOpen" @click.away="isSettingsPanelOpen = false" x-transition:enter="transition transform duration-300" x-transition:enter-start="translate-x-full opacity-30  ease-in" x-transition:enter-end="translate-x-0 opacity-100 ease-out" x-transition:leave="transition transform duration-300" x-transition:leave-start="translate-x-0 opacity-100 ease-out" x-transition:leave-end="translate-x-full opacity-0 ease-in" class="fixed inset-y-0 right-0 flex flex-col bg-white shadow-lg bg-opacity-20 w-80" style="backdrop-filter: blur(14px); -webkit-backdrop-filter: blur(14px)">
                <div class="flex items-center justify-between flex-shrink-0 p-2">
                    <h6 class="p-2 text-lg">Settings</h6>
                    <button @click="isSettingsPanelOpen = false" class="p-2 rounded-md focus:outline-none focus:ring">
                        <svg class="w-6 h-6 text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="flex-1 max-h-full p-4 overflow-hidden hover:overflow-y-scroll">
                    <span>Settings Content</span>
                    <!-- Settings Panel Content ... -->
                </div>
            </div>
        </div>
    </div>

    @livewire('notifications')
    <script>
        const setup = () => {
            function getSidebarStateFromLocalStorage() {
                // if it already there, use it
                if (window.localStorage.getItem('isSidebarOpen')) {
                    return JSON.parse(window.localStorage.getItem('isSidebarOpen'))
                }

                // else return the initial state you want
                return (
                    false
                )
            }

            function setSidebarStateToLocalStorage(value) {
                window.localStorage.setItem('isSidebarOpen', value)
            }

            return {
                loading: true,
                isSidebarOpen: getSidebarStateFromLocalStorage(),
                toggleSidbarMenu() {
                    this.isSidebarOpen = !this.isSidebarOpen
                    setSidebarStateToLocalStorage(this.isSidebarOpen)
                },
                isSettingsPanelOpen: false,
                isSearchBoxOpen: false,
            }
        }
    </script>
</body>

</html>