@extends('layouts.account', ['title' => 'التنبيهات'])
@section('content')
<div class="grid grid-cols-1 gap-6">
    @forelse ($notifications as $notification)
    @php
    @endphp
    <div class="{{ $notification->read_at ? 'bg-white' : 'bg-blue-50'}} w-full p-3 rounded shadow flex flex-shrink-0">
        <div class="w-full">
            @include('pages.account.notifications.partials.order-created-notification')
        </div>
    </div>
    @empty
    <p>لاتوجد أي تنبيهات</p>
    @endforelse
    <div class="flex items-center justiyf-between">
        <hr class="w-full">
        <p tabindex="0" class="focus:outline-none text-sm flex flex-shrink-0 leading-normal px-3 py-16 text-gray-500">هذا كل شيء في الوقت الراهن :)</p>
        <hr class="w-full">
    </div>
</div>
@endsection