@extends('layouts.dashboard', ['pageTitle' => __('Notifications')])
@section('content')
<div class="grid grid-cols-1 gap-6">
    @forelse ($notifications as $notification)
    @php
        $notificationView = Str::kebab(class_basename($notification->type));
    @endphp
    <div class="{{ $notification->read_at ? 'bg-white' : 'bg-blue-50'}} w-full p-3 rounded shadow flex flex-shrink-0">
        <div class="w-full">
            @include('pages.office.notifications.partials.' . $notificationView)
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