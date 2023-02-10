@extends('layouts.dashboard', ['pageTitle' => __('Office settings')])

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
                            <span class="flex-1 ml-3 rtl:mr-3 whitespace-nowrap">{{ $menuItem['label'] }}</span>
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
                @if(empty($tab) || !in_array($currentUrl, array_column($menu, 'link')))
                <livewire:office.edit-settings :digitalOffice="$digitalOffice" />
                <div class="hidden sm:block" aria-hidden="true">
                    <div class="py-5">
                        <div class="border-t border-gray-200"></div>
                    </div>
                </div>
                <livewire:office.location-form :digitalOffice="$digitalOffice" />
                @elseif($tab === 'withdrawal')
                <livewire:office.settings.withdrawal.table />
                @elseif($tab === 'subscription')

                @if(session()->has('success'))
                <div class="bg-green-100 border font-semibold text-green-900 border-green-700 rounded-lg p-4 mb-6">
                    {{ session()->get('success') }}
                </div>
                @endif
                @error('message')
                <div class="bg-red-100 border font-semibold text-red-900 border-red-700 rounded-lg p-4 mb-6">
                    {{ $message }}
                </div>
                <livewire:office.settings.subscription :digitalOffice="$digitalOffice" />
                @endif
            </div>
        </div>
    </div>
</div>
@endsection