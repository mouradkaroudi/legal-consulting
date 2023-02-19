@php
$userTxnWithdrawalMethod = $record->transactionable->withdrawalTransactionMethod($record);
@endphp
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
        <dd class="mt-1  text-gray-900 sm:col-span-2 sm:mt-0">
          {{ __('transactions.' . $record->status) }}
        </dd>
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
        <dt class=" font-medium text-gray-500">{{ __('preferred withdrawal method') }}</dt>
        <dd class="mt-1  text-gray-900 sm:col-span-2 sm:mt-0">
          @if($userTxnWithdrawalMethod)
            {{ $userTxnWithdrawalMethod['name'] }}
            <ul>
            @foreach($userTxnWithdrawalMethod['fields'] as $field)
              <li>{{ $field['label'] . ': ' . $field['value'] }}</li>
            @endforeach
            </ul>
          @else
          -
          @endif
        </dd>
      </div>

      <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
        <dt class=" font-medium text-gray-500">وسيلة الدفع</dt>
        <dd class="mt-1  text-gray-900 sm:col-span-2 sm:mt-0">
          {{ $record->payment_method }}
        </dd>
      </div>

      <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
        <dt class="font-medium text-gray-500">مرفقات</dt>
        <dd class="mt-1 text-gray-900 sm:col-span-2 sm:mt-0">
          @if(!empty($record->attachments))
          <ul role="list" class="divide-y divide-gray-200 rounded-md border border-gray-200">
            @foreach($record->attachments as $attachment)
            <li class="flex items-center justify-between py-3 pl-3 pr-4">
              <div class="flex w-0 flex-1 items-center">
                <x-heroicon-o-link class="h-5 w-5 flex-shrink-0 text-gray-400" />
                <a href="{{ $attachment }}" target="_blank" class="mr-2 w-0 flex-1 truncate">{{ __('File link') }}</a>
              </div>
            </li>
            @endforeach
          </ul>
          @else
          -
          @endif
        </dd>
      </div>
    </dl>
  </div>
</div>