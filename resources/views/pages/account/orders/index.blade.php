@extends('layouts.account', ['title' => __('Orders')])

@section('content')

@if(session()->has('success'))
<div class="bg-green-100 border font-semibold text-green-900 border-green-700 rounded-lg p-4 mb-6">
    {{ session()->get('success') }}
</div>
@endif
@error('message')
<div class="bg-red-100 border font-semibold text-red-900 border-red-700 rounded-lg p-4 mb-6">
    {{ $message }}
</div>
@enderror
<livewire:account.orders.table />
@endsection