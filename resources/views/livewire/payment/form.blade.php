<div class="grid grid-cols-1 gap-4" x-data="{method: '{{ $method }}'}">
    <div class="p-6 bg-white border border-gray-200 rounded-lg">
        <ul class="space-y-2 divide-y mb-4">
            <li class="flex justify-between">
                <span class="font-semibold">{{ __('Amount') }}</span>
                <span class="text-gray-700">
                    <x-money amount="{{ $amount }}" currency="sar" convert="true" />
                </span>
            </li>
            <li class="flex justify-between text-sm text-gray-700">
                <span>{{ __('Tax') }} ({{ setting('tax') }}%)</span><span>
                    <x-money amount="{{ $tax }}" currency="sar" convert="true" />
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

    <p class="font-semibold">{{ __('Choose a payment method') }}</p>

    <div class="bg-white border border-gray-200 rounded-lg">
        <div class="flex items-center pr-4">
            <input type="radio" x-model="method" value="credit" name="paymentMethod" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
            <label for="bordered-radio-1" class="w-full py-4 mr-2 font-bold text-gray-900">
                {{ __('Pay from credit') }}
            </label>
        </div>
        <div class="px-6 pb-4" x-cloak x-show="method == 'credit'">
            <livewire:payment.credit :onlyAccount="$onlyAccountCredit" :entity="$entity" :entityId="$entityId"/>
        </div>
    </div>

    <div class="flex items-center my-2 before:flex-1 before:border-t before:border-gray-300 before:mt-0.5 after:flex-1 after:border-t after:border-gray-300 after:mt-0.5">
        <p class="text-center font-semibold mx-4 mb-0">{{ __('Or make a deposit') }}</p>
    </div>

    <div class="bg-white border border-gray-200 rounded">
        <div class="flex items-center pr-4">
            <input type="radio" x-model="method" value="paypal" name="paymentMethod" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
            <label for="bordered-radio-1" class="w-full py-4 mr-2 font-bold text-gray-900">
                {{ __('PayPal') }}
            </label>
        </div>
        <div class="px-6 pb-4" x-cloak x-show="method == 'paypal'">
            <livewire:payment.gateways.paypal.form :entity="$entity" :entityId="$entityId"/>
        </div>
    </div>
    <div class="bg-white border border-gray-200 rounded">
        <div class="flex items-center pr-4">
            <input type="radio" x-model="method" value="bank-transfer" name="paymentMethod" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
            <label for="bordered-radio-1" class="w-full py-4 mr-2 font-bold text-gray-900">
                {{ __('Bank transfer') }}
            </label>
        </div>
        <div class="px-6 pb-4" x-cloak x-show="method == 'bank-transfer'">
            <livewire:payment.bank-transfer-form :entity="$entity" :entityId="$entityId"/>
        </div>
    </div>

</div>

<script>
    document.querySelectorAll('[name="paymentMethod"]').forEach( elm => {
        elm.addEventListener('change', function(e) {
           window.livewire.emit('payment-method-update', e.target.value);
        })
    })
</script>