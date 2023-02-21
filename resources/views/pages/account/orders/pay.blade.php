@extends('layouts.account', ['title' => __('Orders')])

@section('content')
<livewire:account.orders.pay :order="$order"/>
@endsection