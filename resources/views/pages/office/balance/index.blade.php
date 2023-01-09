@extends('layouts.dashboard', ['pageTitle' => 'الرصيد'])

@section('actions')

@endsection

@section('content')
    <livewire:office.balance.overview :office="$office"/>
    <div class="space-y-8 my-8 border-t"></div>
    <div class="grid md:grid-cols-2 gap-6">
    <div class="bg-white border rounded-lg shadow">
        <div class="p-6 border-b">
            <h4 class="leading-4 text-xl font-bold">طلب سحب الرصيد</h4>
        </div>
        <div class="p-6">
            <livewire:office.balance.withdrawals/>
        </div>
    </div>
    </div>
    <div class="space-y-8 my-8 border-t"></div>
    <livewire:office.transactions.table />
@endsection