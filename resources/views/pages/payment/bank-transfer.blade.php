<!DOCTYPE html>
<html dir="rtl" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('layouts.partials.head')
</head>

<body class="antialiased bg-gray-100">
    <div class="w-full p-4 mx-auto md:px-6 lg:px-8 max-w-5xl">
        <div class="border-b pb-2 mb-6">
            <x-filament::button class="mb-4" :color="'secondary'" href="{{ route('account.overview') }}" tag="a" icon="heroicon-o-chevron-right">
                {{ __('Go back to account') }}
            </x-filament::button>
        </div>
    </div>

    <div class="max-w-lg mx-auto">
        <h1 class="text-3xl font-bold mb-2">{{ __('Bank transfer') }}</h1>
        <p class="mb-6 text-xl">
            قم بتحويل المبلغ الذي تريد شحن بحسابك الى الحساب البنكي . <span class="block mt-4 text-center bg-gray-200 rounded-full p-2">{{ setting('transactions_bank_rib') }}</span>
        </p>
        <x-filament::card>
            <livewire:payment.bank-transfer-form />
        </x-filament::card>
    </div>


</body>

</html>