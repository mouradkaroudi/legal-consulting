<div class="overflow-hidden shadow sm:rounded-md">
    <div class="space-y-6 bg-white px-4 py-5 sm:p-6">

        <div>
            <h3 class="text-lg font-medium leading-6 text-gray-900">{{ __('Subscription settings') }}</h3>
            <p class="mt-1 text-sm text-gray-600">{{ __('Office subscription settings on the site.') }}</p>
        </div>
        @if($digitalOffice->subscription)
        <div class="border rounded-lg p-4">
            <div class="flex justify-between">
                <div>
                    <h4 class="text-xl mb-2 font-bold">{{ $digitalOffice->subscription->plan->name }}</h4>
                    <p class="text-sm text-gray-700">{{ $digitalOffice->subscription->plan->description }}</p>
                </div>
                <div>
                    <span class="text-xl font-bold">{{ $digitalOffice->subscription->plan->fee_label }}</span>
                </div>
            </div>
        </div>
        @else
        <p>
            {{ __('You have no subscriptions') }}. 
            <x-filament::link :href="@route('office.subscription.select')">
                {{ __('Subscribe now') }}
            </x-filament::link>
        </p>
        @endif

        @if($expirationDuration)
        <div class="border p-4 rounded-lg bg-red-50 border-red-500">
            <h4 class="font-bold text-xl text-red-700">{{ __('Attention!') }}</h4>
            <p class="text-gray-700 mb-4">
                {{ __('subscriptions.alerts.expiration', ['days_num' => $expirationDuration]) }}
            </p>
            <div>
                <x-filament::button tag="a" href="{{ route('office.subscription.select') }}">
                    {{ __('Renew') }}
                </x-filament::button>
            </div>
        </div>
        @endif
    </div>
</div>