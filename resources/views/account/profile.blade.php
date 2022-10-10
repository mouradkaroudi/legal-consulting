@extends('layouts.account', ['title' => 'الحساب'])
@section('content')
<div>
    <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="md:col-span-1">
            <div class="px-4 sm:px-0">
                <h3 class="text-lg font-medium leading-6 text-gray-900">إعدادت الحساب</h3>
                <p class="mt-1 text-sm text-gray-600">تضم معلومات الاتصال بك و معلوماتك الشخصية</p>
            </div>
        </div>
        <div class="mt-5 md:col-span-2 md:mt-0">
            <form action="#" method="POST">
                <div class="shadow sm:overflow-hidden sm:rounded-md">
                    <div class="space-y-6 bg-white px-4 py-5 sm:p-6">
                        <livewire:account.profile />
                    </div>
                    <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                        <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-blue-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">حفظ</button>
                    </div>
                </div>
            </form>
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
            <form action="#" method="POST">
                <div class="shadow sm:overflow-hidden sm:rounded-md">
                    <div class="space-y-6 bg-white px-4 py-5 sm:p-6">
                        <livewire:account.password />
                    </div>
                    <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                        <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-blue-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">حفظ</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>

@endsection