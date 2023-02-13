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
            <div>
                <h1 class="text-2xl font-bold mb-2">{{ __('Unlock exclusive benefits with a subscription') }}</h1>
                <p class="text-lg text-gray-700 mb-6">
                    {{ __('We offer you several services to run your office and have an online presence to bring in new clients') }}
                </p>

                <ul class="mb-8 space-y-4 text-left text-gray-500 dark:text-gray-400">
                    <li class="flex items-center space-x-3 rtl:space-x-reverse">
                        <x-heroicon-o-check class="flex-shrink-0 w-5 h-5 text-green-500 dark:text-green-400" />
                        <span class="">{{ __('Strong online presence to attract new customers') }}</span>
                    </li>
                    <li class="flex items-center space-x-3 rtl:space-x-reverse">
                        <x-heroicon-o-check class="flex-shrink-0 w-5 h-5 text-green-500 dark:text-green-400" />
                        <span>{{ __('Control panel to manage your digital office') }}</span>
                    </li>
                    <li class="flex items-center space-x-3 rtl:space-x-reverse">
                        <x-heroicon-o-check class="flex-shrink-0 w-5 h-5 text-green-500 dark:text-green-400" />
                        <span>{{ __('Subscribing guarantees access to all future developments') }}</span>
                    </li>
                </ul>

            </div>
            <div>

                @error('message')
                <div class="bg-red-100 border font-semibold text-red-900 border-red-700 rounded-lg p-4 mb-6">
                    {{ $message }}
                </div>
                @enderror

                <div class="border bg-blue-100 border-blue-500 rounded-lg p-4 mb-6">
                    <div class="flex justify-between">
                        <div>
                            <h4 class="text-xl mb-2 font-bold">{{ $plan->name }}</h4>
                            <p class="text-sm text-gray-700">{{ $plan->description }}</p>
                        </div>
                        <div>
                            <span class="text-xl font-bold">{{ $plan->fee_label }}</span>
                        </div>
                    </div>
                </div>

                <livewire:payment.form 
                    :amount="$plan->amount"
                    entity="subscription"
                    :entityId="$plan->id"
                />
            </div>

        </div>

    </div>
</body>

</html>