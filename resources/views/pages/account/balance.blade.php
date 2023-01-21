@extends('layouts.account', ['title' => 'الرصيد'])
@section('content')
<livewire:account.balance-overview/>

<div class="space-y-8 my-8 border-t"></div>
<div class="grid md:grid-cols-2 gap-6">
    <div class="bg-white border rounded-lg shadow">
        <div class="p-6 border-b">
            <h4 class="leading-4 text-xl font-bold">طلب سحب الرصيد</h4>
        </div>
        <div class="p-6">
            <livewire:account.request-withdrawal-form />
        </div>
    </div>
</div>

<div class="space-y-8 my-8 border-t"></div>

<livewire:account.transactions-table />

@endsection