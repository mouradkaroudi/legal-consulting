<div class="flex flex-col">
    <div class="w-full p-6 border rounded-lg mb-6">
        <div class="divide-y">
            <div class="flex gap-4 py-2">
                <span class="text-gray-700">{{ __('Service') }}</span> <span class="text-black font-semibold">{{ $subject }}</span>
            </div>
            <div class="flex gap-4 py-2 last:pb-0">
                <span class="text-gray-700">{{ __('Office name') }}</span> <span class="text-black font-semibold">{{ $officeName }}</span>
            </div>
        </div>
    </div>
    <div class="p-6 border rounded-lg mt-auto">
        <h4 class="border-b pb-2 mb-4 text-lg font-semibold">{{ __('Payment summary') }}</h4>

        <ul class="space-y-4 mb-6">
            <li class="flex justify-between">
                <span class="text-lg font-semibold">{{ __('Office fees') }}</span>
                <span class="text-gray-700">
                    <x-money amount="{{ $amount }}" currency="sar" convert="true" />
                </span>
            </li>
            <li class="flex justify-between text-sm text-gray-700">
                <span>{{ __('Tax') }} ({{ setting('tax') }}%)</span><span>
                    <x-money amount="{{ $taxAmount }}" currency="sar" convert="true" />
                </span>
            </li>
        </ul>
        <div class="flex justify-between">
            <span class="font-semibold">{{ __('Total') }}</span>
            <span class="font-semibold text-green-700">
                <x-money amount="{{ $totalAmount }}" currency="sar" convert="true" />
            </span>
        </div>
    </div>
</div>