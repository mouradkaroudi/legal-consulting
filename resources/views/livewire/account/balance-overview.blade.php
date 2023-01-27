<div class="grid md:grid-cols-3 gap-6">
    <div class="p-6 rounded-lg border shadow-md">
        <span class="text-gray-600 text-sm">{{ __('Total balance') }}</span>
        <h4 class="text-2xl font-bold">@money($totalBalance, 'sar', true)</h4>
    </div>
    <div class="p-6 rounded-lg border shadow-md">
        <span class="text-gray-600 text-sm">{{ __('Hold balance') }}</span>
        <h4 class="text-2xl font-bold">@money($balanceInHold, 'sar', true)</h4>
    </div>
    <div class="p-6 rounded-lg border shadow-md">
        <span class="text-gray-600 text-sm">{{ __('Available balance') }}</span>
        <h4 class="text-2xl font-bold">@money($availableBalance, 'sar', true)</h4>
    </div>
</div>