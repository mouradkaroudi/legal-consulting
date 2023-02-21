<div class="grid grid-cols-1 gap-4" x-data="{method: '{{ $method }}'}">

    <p class="font-semibold">{{ __('Choose a payment method') }}</p>

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