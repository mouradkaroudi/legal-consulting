<!DOCTYPE html>
<html dir="rtl" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('layouts.partials.head')
</head>

<body class="antialiased bg-gray-100">
    <div class="w-full p-4 mx-auto md:px-6 lg:px-8 max-w-5xl">
        <div class="border-b pb-2 mb-6">
            <x-filament::button class="mb-4" :color="'secondary'" href="{{ route('account.overview') }}" tag="a" icon="heroicon-o-chevron-right">
                رجوع للحساب
            </x-filament::button>
        </div>

        <div class="grid grid-cols-1 gap-6">
            <x-filament::card>
                <div class="flex justify-between align-middle">
                    <h2 class="text-xl font-bold mb-2">{{ $professionSubscriptionPlan->name }}</h2>
                    <h2 class="text-xl font-bold">{{ $professionSubscriptionPlan->fee_label }}</h2>
                </div>
                <p>{{ $professionSubscriptionPlan->description }}</p>
            </x-filament::card>
            <livewire:payment.form :type="'subscription'" :params="['plan_id' => $professionSubscriptionPlan->id]"/>
        </div>

    </div>
</body>

</html>