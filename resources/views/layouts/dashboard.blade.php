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

                        <div class="filament-header space-y-2 items-start justify-between sm:flex sm:space-y-0 sm:space-x-4  sm:rtl:space-x-reverse sm:py-4">
                            <h1 class="text-3xl font-bold tracking-tight text-gray-900">{{ $pageTitle }}</h1>
                        </div>
                        @yield('content')
                    </div>
                </main>
                @include('layouts.partials.footer')
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