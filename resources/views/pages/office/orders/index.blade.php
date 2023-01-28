@extends('layouts.dashboard', ['pageTitle' => __('Orders')])

@section('content')
    <livewire:office.orders.table :office="$office"/>
@endsection