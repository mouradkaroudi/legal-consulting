<div class="overflow-hidden shadow sm:rounded-md">
    <div class="space-y-6 bg-white px-4 py-5 sm:p-6">

        <div>
            <h3 class="text-lg font-medium leading-6 text-gray-900">إعدادات الإشتراك</h3>
            <p class="mt-1 text-sm text-gray-600">إعدادات الإشتراك الخاص بالمكتب في الموقع.</p>
        </div>

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

        @if($expirationDuration)
        <div class="border p-4 rounded-lg bg-red-50 border-red-500">
            <h4 class="font-bold text-xl text-red-700">تنبيه!</h4>
            <p class="text-gray-700 mb-4">
                {{ __('subscriptions.alerts.expiration', ['days_num' => $expirationDuration]) }}
            </p>
            <div>
                <x-filament::button tag="a" href="{{ route('office.subscription.index') }}">
                    {{ __('subscriptions.actions.renew') }}
                </x-filament::button>
            </div>
        </div>
        @endif
    </div>
</div>