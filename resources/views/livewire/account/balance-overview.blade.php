<div class="grid md:grid-cols-3 gap-6">
    <div class="p-6 rounded-lg border shadow-md">
        <span class="text-gray-600 text-sm">الرصيد الكلي</span>
        <h4 class="text-2xl font-bold">{{ $totalBalance }} SAR</h4>
    </div>
    <div class="p-6 rounded-lg border shadow-md">
        <span class="text-gray-600 text-sm">الرصيد المعلق</span>
        <h4 class="text-2xl font-bold">{{ $balanceInHold }} SAR</h4>
    </div>
    <div class="p-6 rounded-lg border shadow-md">
        <span class="text-gray-600 text-sm">الرصيد المتوفر</span>
        <h4 class="text-2xl font-bold">{{ $availableBalance }} SAR</h4>
    </div>
</div>