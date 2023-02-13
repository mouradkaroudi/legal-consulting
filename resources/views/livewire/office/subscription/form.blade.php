<div>


   {{ $this->paymentAccountOptionsForm }}

   <div>
      <div class="mb-4">
         <ul class="space-y-2">
            <li class="flex justify-between">
               <span class="font-semibold">{{ __('Amount') }}</span>
               <span class="text-gray-700">
                  <x-money amount="0" currency="sar" convert="true" />
               </span>
            </li>
            <li class="flex justify-between text-sm text-gray-700">
               <span>{{ __('Tax') }} ({{ setting('tax') }}%)</span><span>
                  <x-money amount="0" currency="sar" convert="true" />
               </span>
            </li>
         </ul>
         <div class="flex justify-between">
            <span class="font-semibold">{{ __('Total') }}</span>
            <span class="font-semibold text-green-700">
               <x-money amount="0" currency="sar" convert="true" />
            </span>
         </div>
      </div>
   </div>

</div>
<!-- Add new component to handle pricing calculation(payment-summary)  -->