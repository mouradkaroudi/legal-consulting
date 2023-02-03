<!DOCTYPE html>
<html dir="rtl" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('layouts.partials.head', ['title' => __('Setup office')])
</head>

<body class="antialiased bg-gray-100">
    <div class="w-full p-4 mx-auto md:px-6 lg:px-8 max-w-5xl">
        <div class="border-b pb-2 mb-6">
            <x-filament::button class="mb-4" :color="'secondary'" href="{{ route('account.overview') }}" tag="a" icon="heroicon-o-chevron-right">
                {{ __('Go back to account') }}
            </x-filament::button>
        </div>
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold mb-2">{{ __('You are only a few steps behind opening your office') }}</h1>
            <p class="text-lg">
                {{ __('Please fill in all required fields to open your office') }}.
            </p>
        </div>
        <livewire:office.setup.required-information-form />
    </div>
</body>

</html>