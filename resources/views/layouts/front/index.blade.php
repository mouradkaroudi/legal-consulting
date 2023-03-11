@props(['title' => '', 'metaDescription' => ''])
@php
$whatsapp_number = setting('whatsapp_number');
if(!empty($whatsapp_number)) {
$whatsapp_number = explode(',', $whatsapp_number);
}
$wsTextColor = setting('homepage_whatsapp_textcolor');
$wsBgColor = setting('homepage_whatsapp_bgcolor');
@endphp
<!DOCTYPE html>
<html dir="{{ isRtl() ? 'rtl': 'ltr' }}" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

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

    @if(!empty($whatsapp_number))
    <div class="p-4 text-center" style="background-color: {{ $wsBgColor }}; color: {{ $wsTextColor }};">
        <div class="flex justify-center gap-2">
            <x-dynamic-component component="social-icons.whatsapp" class="w-4 h-4" />
            <span>{{ __('Contact us via') }} </span>
            <div class="flex gap-2">
                @foreach($whatsapp_number as $whatsapp_num)
                <a class="font-bold" href="https://wa.me/{{ $whatsapp_num }}" target="_blank">{{ $whatsapp_num }}</a>
                <x-heroicon-o-external-link class="w-4 h-4 rtl:rotate-[270deg]" />
                @endforeach
            </div>
        </div>
    </div>
    @endif

    <livewire:front.navigation />
    @yield('content')
    <livewire:shared.widgets.footer />

    @livewire('notifications')
</body>

</html>