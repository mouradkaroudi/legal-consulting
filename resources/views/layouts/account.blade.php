@props(['title' => ''])
<!DOCTYPE html>
<html dir="{{ app()->getLocale() == 'ar' ? 'rtl': 'ltr' }}" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">

    <meta name="application-name" content="{{ config('app.name') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@400;500;700&display=swap" rel="stylesheet">

    <title>{{ site_name() . ($title ? ' - ' . $title : '') }}</title>

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
    <div class="min-h-full">
        <livewire:account.navigation />
        <header class="bg-white shadow">
            <div class="mx-auto max-w-7xl py-6 px-4 sm:px-6 lg:px-8">
                <h1 class="text-3xl font-bold tracking-tight text-gray-900">{{ $title }}</h1>
            </div>
        </header>
        <main>
            <div class="mx-auto max-w-7xl py-6 px-4 sm:px-6 lg:px-8">
                @yield('content')
            </div>
        </main>
    </div>
    @include('layouts.partials.footer')
    @livewire('notifications')
</body>

</html>