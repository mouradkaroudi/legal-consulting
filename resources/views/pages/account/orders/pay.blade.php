@extends('layouts.account', ['title' => 'دفع الطلب رقم #' . $order->id])

@section('content')
    <livewire:account.orders.payment-summary />
@endsection