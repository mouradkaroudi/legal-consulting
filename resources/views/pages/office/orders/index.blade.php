@extends('layouts.dashboard', ['pageTitle' => 'الطلبات'])

@section('content')
    <livewire:office.orders.table/>
@endsection