@extends('layouts.account', ['title' => 'التنبيهات'])
@section('content')
<div class="grid grid-cols-1 gap-6">
    @forelse ($notifications as $notification)
    <div class="w-full p-3 bg-white rounded shadow flex flex-shrink-0">
        <div class="w-full">
            @include('pages.account.notifications.partials.invitation-request-notification')
        </div>
    </div>
    @empty
    <p>No notifications</p>
    @endforelse
    <div class="flex items-center justiyf-between">
        <hr class="w-full">
        <p tabindex="0" class="focus:outline-none text-sm flex flex-shrink-0 leading-normal px-3 py-16 text-gray-500">Thats it for now :)</p>
        <hr class="w-full">
    </div>
</div>
@endsection