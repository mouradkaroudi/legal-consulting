<div class="grid grid-cols-2 gap-6">
    <div>
        <div class="w-full p-6 border rounded-lg">
            <div class="">
                <h5 class="text-black">{{ __('You must pay') }}</h5>
                <div class="flex flex-row items-end"> <span class="text-black text-3xl font-bold">
                        <x-money :amount="$amount" :currency="'sar'" :convert="true" />
                    </span></div>
            </div>
            <div class="flex w-full mt-3 mb-3"> <span class="border border-dashed w-full border-black"></span> </div>
            <div class="space-y-5 divide-y">
                <div class="flex flex-col">
                    <span class="text-gray-700">{{ __('Office name') }}</span> <span class="text-black text-lg font-bold">{{ $officeName }}</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-gray-700">{{ 'Order' }} #</span> <span class="text-black text-lg font-bold">{{ $orderID }}</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-gray-700">{{ __('Service') }}</span> <span class="text-black text-lg font-bold">{{ $subject }}</span>
                </div>
            </div>
        </div>
    </div>
    <div>
        <livewire:account.payment.order.form />
    </div>

</div>