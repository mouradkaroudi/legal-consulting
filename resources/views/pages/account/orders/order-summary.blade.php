<div class="md:flex">
    <div class="w-full p-3">
        <div class="p-3">
            <h5 class="text-black">عليك أن تدفع</h5>
            <div class="flex flex-row items-end"> <span class="text-black text-3xl font-bold">
                <x-money :amount="$amount" :currency="'sar'" :convert="true" />
            </span></div>
        </div>
        <div class="flex w-full mt-3 mb-3"> <span class="border border-dashed w-full border-black"></span> </div>
            <div class="p-3 space-y-5">
                <div class="flex flex-col"> <span class="text-gray-700">المكتب</span> <span class="text-black text-lg font-bold">{{ $officeName }}</span> </div>
                <div class="flex flex-col"> <span class="text-gray-700">الطلب #</span> <span class="text-black text-lg font-bold">{{ $orderID }}</span> </div>
                <div class="flex flex-col"> <span class="text-gray-700">الخدمة</span> <span class="text-black text-lg font-bold">{{ $subject }}</span> </div>
            </div>
        </div>
    </div>
</div>
