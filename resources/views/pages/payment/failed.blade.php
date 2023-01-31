<!DOCTYPE html>
<html dir="rtl" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('layouts.partials.head')
    
</head>

<body class="antialiased bg-gray-100">
    <!-- component -->
    <div class="bg-gray-100 h-screen">
        <div class="bg-white p-6  md:mx-auto">
            <x-heroicon-o-x-circle class="text-red-600 w-16 h-16 mx-auto my-6"/>
            <div class="text-center">
                <h3 class="md:text-2xl text-base text-gray-900 font-semibold text-center">{{ __("Sorry! we're unable to process this payment") }}</h3>
                <p class="text-gray-600 my-2">{{ __('Please retry again or contact our support') }}.</p>
                <x-filament::button tag="a" href="{{ @route('account.orders.index') }}">
                    {{ __('Go back to orders') }}
                </x-filament::button>
            </div>
        </div>
    </div>
</body>

</html>