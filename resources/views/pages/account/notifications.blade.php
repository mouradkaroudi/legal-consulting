@extends('layouts.account', ['title' => 'التنبيهات'])
@section('content')
<div class="grid grid-cols-1 gap-6">
    <div class="w-full p-3 bg-white rounded shadow flex flex-shrink-0">
        <div class="w-full">
            <div class="flex items-center justify-between w-full">
                <p tabindex="0" class="focus:outline-none leading-none"><span class="text-indigo-700">Sash</span> added you to the group: <span class="text-indigo-700">UX Designers</span></p>
                <div tabindex="0" aria-label="close icon" role="button" class="focus:outline-none cursor-pointer">
                    <img src="https://tuk-cdn.s3.amazonaws.com/can-uploader/notification_1-svg4.svg" alt="icon" />
                </div>
            </div>
            <p tabindex="0" class="focus:outline-none text-xs leading-3 pt-2 text-gray-500">2 hours ago</p>
        </div>
    </div>
    <div class="flex items-center justiyf-between">
        <hr class="w-full">
        <p tabindex="0" class="focus:outline-none text-sm flex flex-shrink-0 leading-normal px-3 py-16 text-gray-500">Thats it for now :)</p>
        <hr class="w-full">
    </div>
</div>
@endsection