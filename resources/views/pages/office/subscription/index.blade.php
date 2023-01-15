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

        <div class="grid grid-cols-2 gap-6">
            <div>
                <h1 class="text-2xl font-bold mb-2">افتح المزايا الحصرية بالاشتراك</h1>
                <p class="text-lg text-gray-700 mb-6">نقدم لكم عدة خدمات لتسيير مكتبكم, حضور على الأنترنيت لجلب عملاء جدد</p>

                <ul class="mb-8 space-y-4 text-left text-gray-500 dark:text-gray-400">
                    <li class="flex items-center space-x-3">
                        <!-- Icon -->
                        <svg class="flex-shrink-0 w-5 h-5 text-green-500 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="">حضور قوي على الأنترنيت لجلب عملاء جدد</span>
                    </li>
                    <li class="flex items-center space-x-3">
                        <!-- Icon -->
                        <svg class="flex-shrink-0 w-5 h-5 text-green-500 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span>لوحة تحكم لإدارة مكتبك الرقمي</span>
                    </li>
                    <li class="flex items-center space-x-3">
                        <!-- Icon -->
                        <svg class="flex-shrink-0 w-5 h-5 text-green-500 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span>الإشتراك يضمن الوصل لكل التطويرات المستقبلية</span>
                    </li>
                </ul>

            </div>
            <x-filament::card>
                <h2 class="text-xl font-bold mb-2">خطة الإشتراك</h2>
                <p>إختر الخطة المناسبة لك</p>
                <livewire:office.subscription.form />
            </x-filament::card>
        </div>

    </div>
</body>

</html>