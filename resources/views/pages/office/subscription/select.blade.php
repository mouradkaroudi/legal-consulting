<!DOCTYPE html>
<html dir="rtl" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('layouts.partials.head')
</head>

<body class="antialiased bg-gray-100">
    <div class="w-full p-4 mx-auto md:px-6 lg:px-8 max-w-5xl">
        <div class="border-b pb-2 mb-6">
            <x-filament::button class="mb-4" :color="'secondary'" href="{{ route('account.overview') }}" tag="a" icon="heroicon-o-chevron-right">
                {{ __('Back to account') }}
            </x-filament::button>
        </div>

        <div class="grid grid-cols-2 gap-6">
            @foreach($plans as $plan)
            <a href="{{ route('office.subscription.index', ['profession_subscription_plan' => $plan->id]) }}" class="border bg-white hover:bg-gray-200  rounded-lg p-4 mb-6">
                <div class="flex justify-between">
                    <div>
                        <h4 class="text-xl mb-2 font-bold">{{ $plan->name }}</h4>
                        <p class="text-sm text-gray-700">{{ $plan->description }}</p>
                    </div>
                    <div>
                        <span class="text-xl font-bold">{{ $plan->fee_label }}</span>
                    </div>
                </div>
            </a>
            @endforeach

        </div>

    </div>
</body>

</html>