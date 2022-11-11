@extends('layouts.account', ['title' => 'دفع الطلب رقم #' . $order->id])

@section('content')
<div class="w-full bg-whitepx-5 py-10 text-gray-800">
        <div class="w-full">
            <div class="-mx-3 md:flex items-start">
                <div class="px-3 md:w-7/12 lg:pr-10">
                    <div class="w-full mx-auto text-gray-800 font-light mb-6 border-b border-gray-200 pb-6">
                        <div class="w-full flex items-center">
                            <div class="flex-grow pl-3">
                                <h6 class="font-semibold uppercase text-gray-600">{{ $order->subject }}</h6>
                            </div>
                            <div>
                                <span class="font-semibold text-gray-600 text-xl">{{ $order->formattedFee }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="mb-6 pb-6 border-b border-gray-200 text-gray-800">
                        <div class="w-full flex mb-3 items-center">
                            <div class="flex-grow">
                                <span class="text-gray-600">تكاليف المكتب</span>
                            </div>
                            <div class="pl-3">
                                <span class="font-semibold">{{ $order->formattedFee }}</span>
                            </div>
                        </div>
                        <div class="w-full flex items-center">
                            <div class="flex-grow">
                                <span class="text-gray-600">تكاليف الخدمة</span>
                            </div>
                            <div class="pl-3">
                                <span class="font-semibold">SAR 0.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="mb-6 pb-6 border-b border-gray-200 md:border-none text-gray-800 text-xl">
                        <div class="w-full flex items-center">
                            <div class="flex-grow">
                                <span class="text-gray-600">المجموع</span>
                            </div>
                            <div class="pl-3">
                                <span class="font-semibold">{{ $order->formattedFee }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-3 md:w-5/12">
                    <livewire:account.orders.payment-form :orderId="$order->id"/>
                </div>
            </div>
        </div>
    </div>

@endsection