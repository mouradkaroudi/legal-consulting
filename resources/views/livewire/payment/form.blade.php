<div class="grid grid-cols-1 gap-6" x-data="{method: 'balance'}">
    <div>
        <ul class="space-y-2 mb-4">
            <li class="flex justify-between">
                <span class="font-semibold">{{ __('Amount') }}</span>
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
    <div class="bg-white border border-gray-200 rounded">
        <div class="flex items-center pr-4">
            <input type="radio" x-model="method" value="paypal" name="bordered-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
            <label for="bordered-radio-1" class="w-full py-4 mr-2 font-bold text-gray-900">
                {{ __('PayPal') }}
            </label>
        </div>
        <div class="px-6 pb-4" x-cloak x-show="method == 'paypal'">
            <livewire:payment.gateways.paypal.form />
        </div>
    </div>
    <div class="bg-white border border-gray-200 rounded">
        <div class="flex items-center pr-4">
            <input type="radio" x-model="method" value="bank-transfer" name="bordered-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
            <label for="bordered-radio-1" class="w-full py-4 mr-2 font-bold text-gray-900">
                {{ __('Bank transfer') }}
            </label>
        </div>
        <div class="px-6 pb-4" x-cloak x-show="method == 'bank-transfer'">
            <livewire:payment.bank-transfer-form />
        </div>
    </div>

</div>