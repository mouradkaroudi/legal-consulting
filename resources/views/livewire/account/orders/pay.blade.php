<div class="grid grid-cols-2 gap-6">
    <div class="w-full">
        <div class="p-6 bg-white border border-gray-200 rounded-lg divide-y mb-6">
            <div class="flex gap-4 py-2">
                <span class="text-gray-700">{{ __('Service') }}</span> <span class="text-black font-semibold">{{ $order->subject }}</span>
            </div>
            <div class="flex gap-4 py-2 last:pb-0">
                <span class="text-gray-700">{{ __('Office name') }}</span> <span class="text-black font-semibold">{{ $order->office->name }}</span>
            </div>
        </div>
        <div class="p-6 bg-white border border-gray-200 rounded-lg">
            <ul class="divide-y mb-4">
                <li class="flex justify-between py-2">
                    <span class="font-semibold">{{ __('Amount') }}</span>
                    <span class="text-gray-700">
                        <x-money amount="{{ $order->amount }}" currency="sar" convert="true" />
                    </span>
                </li>
                <li class="flex justify-between text-sm text-gray-700 py-2 last:pb-0">
                    <span>{{ __('Tax') }} ({{ $taxRate }}%)</span><span>
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

    <div>
        <div class="bg-white border border-gray-200 rounded">
            @if(session()->has('success'))
            <div class="bg-green-100 border font-semibold text-green-900 border-green-700 rounded-lg p-4 mb-6">
                {{ session()->get('success') }}
            </div>
            @endif
            <div class="flex items-center pr-4">
                <input type="radio" name="isBalancePaymentSelected" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2" {{ $isBalancePaymentSelected ? "checked" : "" }}>
                <label for="bordered-radio-1" class="w-full py-4 mr-2 font-bold text-gray-900">
                    {{ __('Account balance') }}
                </label>
            </div>
            <div class="px-6 pb-4">
                <form wire:submit.prevent="submit">
                    <p class="mb-2 text-gray-700">
                        {{ __("The amount will be deducted from your account balance") }}.
                    </p>
                    {{ $this->form }}
                    @if($errors->has('balance'))
                    <p class="text-sm text-danger-600">
                        {{ $errors->first('balance') }}
                    </p>

                    @endif
                    <x-filament::button size="lg" class="w-full" :type="'submit'">
                        {{ __('Complete the payment') }}
                    </x-filament::button>
                </form>
            </div>
        </div>

        <div class="flex items-center my-2 before:flex-1 before:border-t before:border-gray-300 before:mt-0.5 after:flex-1 after:border-t after:border-gray-300 after:mt-0.5">
            <p class="text-center font-semibold mx-4 mb-0">{{ __('Or make a deposit') }}</p>
        </div>
        <livewire:payment.form :amount="$order->amount" entity="order" :entityId="$order->id" />
    </div>

</div>
<script>
    document.querySelector('[name="isBalancePaymentSelected"]').addEventListener('change', function(e) {
        window.livewire.emit('balance-payment-selected', e.target.value == 'on');
    })
</script>