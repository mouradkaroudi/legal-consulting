<!DOCTYPE html>
<html dir="rtl" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('layouts.partials.head')
</head>

<body class="antialiased bg-gray-100">
    <div class="w-full p-4 mx-auto md:px-6 lg:px-8 max-w-5xl">
        <div class="border-b pb-2 mb-6">
            <x-filament::button class="mb-4" :color="'secondary'" href="{{ route('account.overview') }}" tag="a" icon="heroicon-o-chevron-right">
                رجوع للحساب
            </x-filament::button>
        </div>
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold mb-2">خطوات قليلة تفصلك على فتح مكتبك</h1>
            <p class="text-lg">المرجو ادخال المعلومات المطلوبة منك من اجل اكمال فتح مكتب على الموقع.</p>
        </div>
        <livewire:office.setup.required-information-form />
    </div>
</body>

</html>