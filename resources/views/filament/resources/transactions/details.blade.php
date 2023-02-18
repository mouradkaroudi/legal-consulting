<div class="overflow-hidden">
  <div>
    <dl>
      <div class="bg-gray-50 px-4 py-5 grid grid-cols-3 gap-4">
        <dt class=" font-medium text-gray-500">نوع المعاملة</dt>
        <dd class="mt-1  text-gray-900 sm:col-span-2 sm:mt-0">{{ $record->payment_type }}</dd>
      </div>
      <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
        <dt class=" font-medium text-gray-500">المعاملة</dt>
        <dd class="mt-1  text-gray-900 sm:col-span-2 sm:mt-0">{{ $record->description }}</dd>
      </div>
      <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
        <dt class=" font-medium text-gray-500">الحالة</dt>
        <dd class="mt-1  text-gray-900 sm:col-span-2 sm:mt-0">margotfoster@example.com</dd>
      </div>
      <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
        <dt class=" font-medium text-gray-500">المبلغ</dt>
        <dd class="mt-1  text-gray-900 sm:col-span-2 sm:mt-0">
          @money($record->amount, 'sar', true)
        </dd>
      </div>
      <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
        <dt class=" font-medium text-gray-500">الرسوم</dt>
        <dd class="mt-1  text-gray-900 sm:col-span-2 sm:mt-0">
          @money($record->fees, 'sar', true)
        </dd>
      </div>
      <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
        <dt class=" font-medium text-gray-500">وسيلة الدفع</dt>
        <dd class="mt-1  text-gray-900 sm:col-span-2 sm:mt-0">
          {{ $record->payment_method }}
        </dd>
      </div>
      <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
        <dt class=" font-medium text-gray-500">مرفقات</dt>
        <dd class="mt-1  text-gray-900 sm:col-span-2 sm:mt-0">
          <ul role="list" class="divide-y divide-gray-200 rounded-md border border-gray-200">
            <li class="flex items-center justify-between py-3 pl-3 pr-4">
              <div class="flex w-0 flex-1 items-center">
                <!-- Heroicon name: mini/paper-clip -->
                <svg class="h-5 w-5 flex-shrink-0 text-gray-400" xmrns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                  <path fill-rule="evenodd" d="M15.621 4.379a3 3 0 00-4.242 0l-7 7a3 3 0 004.241 4.243h.001l.497-.5a.75.75 0 011.064 1.057l-.498.501-.002.002a4.5 4.5 0 01-6.364-6.364l7-7a4.5 4.5 0 016.368 6.36l-3.455 3.553A2.625 2.625 0 119.52 9.52l3.45-3.451a.75.75 0 111.061 1.06l-3.45 3.451a1.125 1.125 0 001.587 1.595l3.454-3.553a3 3 0 000-4.242z" clip-rule="evenodd" />
                </svg>
                <span class="mr-2 w-0 flex-1 truncate">coverletter_back_end_developer.pdf</span>
              </div>
              <div class="mr-4 flex-shrink-0">
                <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">Download</a>
              </div>
            </li>
          </ul>
        </dd>
      </div>
    </dl>
  </div>
</div>