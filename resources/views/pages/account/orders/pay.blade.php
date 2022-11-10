@extends('layouts.account', ['title' => 'دفع الطلب رقم #' . $order->id])

@section('content')
    <livewire:account.orders.payment-summary />

    <div class="border-t my-8"></div>

    <livewire:account.orders.payment-form :orderId="$order->id"/>
@endsection