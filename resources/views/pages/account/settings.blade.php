@extends('layouts.account', ['title' => 'الحساب'])
@section('content')
<div>
    @if($profile && $profile->status == 'uncompleted')
        <x-alert>
            يرجى إكمال الحقول المطلوبة في ملف التعريف الخاص بك لتتمكن من استخدام حسابك.
        </x-alert>
    @endif
    <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="md:col-span-1">
            <div class="px-4 sm:px-0">
                <h3 class="text-lg font-medium leading-6 text-gray-900">إعدادت الحساب</h3>
                <p class="mt-1 text-sm text-gray-600">تضم معلومات الاتصال بك و معلوماتك الشخصية</p>
            </div>
        </div>
        <div class="mt-5 md:col-span-2 md:mt-0">
            <livewire:account.account-info :user="$user"/>
        </div>
    </div>

    <div class="hidden sm:block" aria-hidden="true">
        <div class="py-5">
            <div class="border-t border-gray-200"></div>
        </div>
    </div>

    <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="md:col-span-1">
            <div class="px-4 sm:px-0">
                <h3 class="text-lg font-medium leading-6 text-gray-900">كملة السر</h3>
                <p class="mt-1 text-sm text-gray-600">تحديث كلمة السر الخاصة بالحساب</p>
            </div>
        </div>
        <div class="mt-5 md:col-span-2 md:mt-0">
            <livewire:account.password />
        </div>
    </div>
    @if($hasProfile)
    <div class="hidden sm:block" aria-hidden="true">
        <div class="py-5">
            <div class="border-t border-gray-200"></div>
        </div>
    </div>

    <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="md:col-span-1">
            <div class="px-4 sm:px-0">
                <h3 class="text-lg font-medium leading-6 text-gray-900">إعدادت الملف الشخصي</h3>
                <p class="mt-1 text-sm text-gray-600">إعدادت الظهور الخاصة في المكاتب</p>
            </div>
        </div>
        <div class="mt-5 md:col-span-2 md:mt-0">
            <livewire:account.profile :profile="$profile"/>
        </div>
    </div>
    @endif

</div>

@endsection