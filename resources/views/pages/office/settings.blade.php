@extends('layouts.dashboard', ['pageTitle' => 'إعدادات المكتب'])

@php
$currentUrl = request()->fullUrl();
@endphp

@section('content')
<div>
    <div>
        <div class="md:grid md:grid-cols-4 md:gap-6">
            <div class="md:col-span-1">
                <ul class="space-y-2">
                    @foreach($menu as $menuItem)
                    <li>
                        <a href="{{ $menuItem['link'] }}" class="
                                flex 
                                items-center 
                                p-2 
                                text-base 
                                rounded-lg 
                                {{ $menuItem['link'] == $currentUrl ? 'bg-gray-200 text-green-700 font-semibold' : 'text-gray-900' }}">
                            <x-dynamic-component :component="$menuItem['icon']" class="w-6 h-6 text-gray-500 transition duration-75" />
                            <span class="flex-1 mr-3 whitespace-nowrap">{{ $menuItem['label'] }}</span>
                            @if(isset($menuItem['badgeCount']))
                            <span class="inline-flex items-center justify-center w-3 h-3 p-3 mr-3 text-sm font-medium text-blue-600 bg-blue-200 rounded-full dark:bg-blue-900 dark:text-blue-200">
                                {{ $menuItem['badgeCount'] }}
                            </span>
                            @endif
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="mt-5 md:col-span-3 md:mt-0">
                @if(empty($tab))
                <livewire:office.edit-settings :digitalOffice="$digitalOffice" />

                <div class="hidden sm:block" aria-hidden="true">
                    <div class="py-5">
                        <div class="border-t border-gray-200"></div>
                    </div>
                </div>
                <livewire:office.location-form :digitalOffice="$digitalOffice" />
                @elseif($tab === 'withdrawal')
                <livewire:office.withdrawal-methods-form />
                @elseif($tab === 'subscription')
                <div class="overflow-hidden shadow sm:rounded-md">
                    <div class="space-y-6 bg-white px-4 py-5 sm:p-6">

                        <div>
                            <h3 class="text-lg font-medium leading-6 text-gray-900">إعدادات الإشتراك</h3>
                            <p class="mt-1 text-sm text-gray-600">إعدادات الإشتراك الخاص بالمكتب في الموقع.</p>
                        </div>

                        <div class="border rounded-lg p-4">
                            <div class="flex justify-between">
                                <div>
                                    <h4 class="text-xl mb-2 font-bold">إشتراك شهري</h4>
                                    <p class="text-sm text-gray-700">إشتراك دائم يخول لك فتح مكتب على موقع المحامي</p>
                                </div>
                                <div>
                                    <span class="text-xl font-bold">120 SAR/ شهريا</span>
                                </div>
                            </div>
                        </div>

                        <div class="border p-4 rounded-lg bg-red-50 border-red-500">
                            <h4 class="font-bold text-xl text-red-700">تنبيه!</h4>
                            <p class="text-gray-700 mb-4">
                                ستنتهي صلاحية هذا الاشتراك يوم الاثنين ، 25. الرجاء تجديد اشتراكك لتجنب فقدان الوصول إلى مكتبك الحجب من الموقع.
                            </p>
                            <div>
                                <x-filament::button>
                                    تجديد الإشتراك
                                </x-filament::button>
                            </div>
                        </div>

                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection