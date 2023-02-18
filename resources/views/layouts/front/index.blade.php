@props(['title' => '', 'metaDescription' => ''])
<!DOCTYPE html>
<html dir="{{ app()->getLocale() == 'ar' ? 'rtl': 'ltr' }}" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">

    <meta name="application-name" content="{{ site_name() }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@400;500;700&display=swap" rel="stylesheet">

    <title>{{ site_name() . ($title ? ' - ' . $title : '') }}</title>
    <meta name="description" content="{{ $metaDescription }}">
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

<body class="bg-gray-100">
    <livewire:front.navigation />
    @yield('content')
    <livewire:shared.widgets.footer />
</body>

</html>