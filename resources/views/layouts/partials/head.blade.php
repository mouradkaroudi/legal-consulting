@props(['title' => ''])
<meta charset="utf-8">

<meta name="application-name" content="{{ config('app.name') }}">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@400;500;700&display=swap" rel="stylesheet">

<title>{{ auth()->user()->currentOffice->name }} - {{ $title }}</title>

<style>
    [x-cloak] {
        display: none !important;
    }
</style>
@vite(['resources/css/app.css', 'resources/js/app.js'])
@livewireStyles
@livewireScripts
@stack('scripts')
