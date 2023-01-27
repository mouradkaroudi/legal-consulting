<div class="grid md:grid-cols-3 gap-6">
    <div class="p-6 rounded-lg border shadow-md">
        <span class="text-gray-600 text-sm">{{ __('Total balance') }}</span>
        <h4 class="text-2xl font-bold">@money($office->hold_balance + $office->available_balance, 'SAR', true)</h4>
    </div>
    <div class="p-6 rounded-lg border shadow-md">
        <span class="text-gray-600 text-sm">{{ __('Hold balance') }}</span>
        <h4 class="text-2xl font-bold">@money($office->hold_balance, 'SAR', true)</h4>
    </div>
    <div class="p-6 rounded-lg border shadow-md">
        <span class="text-gray-600 text-sm">{{ __('Available balance') }}</span>
        <h4 class="text-2xl font-bold">@money($office->available_balance, 'SAR', true)</h4>
    </div>
</div>