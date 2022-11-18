@extends('layouts.dashboard', ['pageTitle' => 'إعدادات المكتب'])

@section('content')
<div>
    <div>
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">معلومات المكتب</h3>
                    <p class="mt-1 text-sm text-gray-600">معلومات عن المكتب و نبذة عنه</p>
                </div>
            </div>
            <div class="mt-5 md:col-span-2 md:mt-0">
                <livewire:office.edit-settings :digitalOffice="$digitalOffice"/>
            </div>
        </div>
    </div>

    <div class="hidden sm:block" aria-hidden="true">
        <div class="py-5">
            <div class="border-t border-gray-200"></div>
        </div>
    </div>

    <div class="mt-10 sm:mt-0">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">موقعك</h3>
                    <p class="mt-1 text-sm text-gray-600">معلومات عن مكان الجغرافي للمكتب.</p>
                </div>
            </div>
            <div class="mt-5 md:col-span-2 md:mt-0">
                <livewire:office.location-form :digitalOffice="$digitalOffice"/>
            </div>
        </div>
    </div>

    <div class="hidden sm:block" aria-hidden="true">
        <div class="py-5">
            <div class="border-t border-gray-200"></div>
        </div>
    </div>

</div>
@endsection