@extends('layouts.account', ['title' => 'لوحة التحكم'])
@section('content')
<div class="mb-8">
    <livewire:account.balance-overview/>
</div>
@if(!empty($offices)):
<div class="mb-8">
    <h2 class="text-2xl font-bold mb-4">المكاتب</h2>
    <livewire:account.offices-listing />
</div>
@endif
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="col-span-2">
        <h2 class="text-2xl font-bold mb-4">آخر الطلبات</h2>
        <livewire:account.orders.table />
    </div>
    <div>
        <h2 class="text-2xl font-bold mb-4">آخر الدعوات</h2>
        <livewire:account.invites.table />
    </div>
</div>
@endsection