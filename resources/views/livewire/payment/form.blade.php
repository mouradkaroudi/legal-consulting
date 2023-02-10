<div>
    <form>
        <div class="grid grid-cols-2 gap-6">
            <x-filament::card>
                {{ $this->form }}
                <div>
                    <ul class="space-y-2 mb-4">
                        <li class="flex justify-between">
                            <span class="font-semibold">{{ __('Amount') }}</span>
                            <span class="text-gray-700">
                                <x-money amount="{{ $amount }}" currency="sar" convert="true" />
                            </span>
                        </li>
                        <li class="flex justify-between text-sm text-gray-700">
                            <span>{{ __('Tax') }} ({{ setting('tax') }}%)</span><span>
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

                <x-filament::button class="w-full mt-4" :type="'submit'" size='lg'>
                    {{ __('Complete the payment') }}
                </x-filament::button>
                <p class="text-sm text-gray-700 mt-4 text-center">
                    {{ __('Additional fees may apply') }}
                </p>
            </x-filament::card>
        </div>

    </form>
</div>