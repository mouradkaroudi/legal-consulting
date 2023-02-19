@extends('layouts.account', ['title' => __('Orders')])

@section('content')
<div class="grid grid-cols-2 gap-6">
    <div class="w-full p-6 border rounded-lg mb-6">
        <div class="divide-y">
            <div class="flex gap-4 py-2">
                <span class="text-gray-700">{{ __('Service') }}</span> <span class="text-black font-semibold">{{ $order->subject }}</span>
            </div>
            <div class="flex gap-4 py-2 last:pb-0">
                <span class="text-gray-700">{{ __('Office name') }}</span> <span class="text-black font-semibold">{{ $order->office->name }}</span>
            </div>
        </div>
    </div>
    <livewire:payment.form :amount="$order->amount" entity="subscription" :entityId="1" />

</div>
@endsection