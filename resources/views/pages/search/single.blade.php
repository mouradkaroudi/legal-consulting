@php
$experiences = [];
$educations = [];
$gender = null;
$specializations = $office->specializations ? $office->specializations : [];
$professionName = $office->profession ? $office->profession->name : null;

if(!empty($office->owner->profile)) {
$experiences = $office->owner->profile->experiences ?? [];
$educations = $office->owner->profile->education ?? [];
$gender = $office->owner->profile->gender;
}

@endphp
@extends('layouts.front.index')
@section('content')
<div class="mx-auto max-w-screen-xl px-4 md:px-6 my-12 min-h-[580px]">
    <div class="md:flex no-wrap md:-mx-2">
        <!-- Left Side -->
        <div class="w-full md:w-3/12 md:mx-2">
            <!-- Profile Card -->
            <div class="bg-white p-3 border-t-4 border-green-700">
                <div class="mb-4 overflow-hidden">
                    @if($office->image)
                    <img class="h-auto w-full mx-auto" src="{{ asset('storage/' . $office->image) }}" alt="{{ $office->name }}">
                    @else
                    <div class="bg-gray-200 w-full text-center rounded-lg min-h-[180px]">
                        <x-heroicon-o-photograph class="mx-auto top-2/4 translate-y-2/4 text-gray-400 w-24 h-24" />
                    </div>
                    @endif
                </div>

                <h1 class="text-gray-900 font-bold text-xl leading-8 my-1">{{ $office->name }}</h1>
                <div class="flex gap-4">
                    @if(!empty($professionName))
                    <span class="bg-blue-700 py-1 px-2 rounded text-white text-sm">{{ $professionName }}</span>
                    @endif
                </div>
                @if($displayMessagingForm)
                <div class="mt-4">
                    <livewire:messages.send-message :officeId="$office->id" />
                </div>
                @endif
                <ul class="bg-gray-100 text-gray-600 hover:text-gray-700 hover:shadow py-2 px-3 mt-3 divide-y rounded shadow-sm">
                    <li class="flex items-center py-3">
                        <span>الحالة</span>
                        <span class="mr-auto"><span class="bg-success-500 py-1 px-2 rounded text-white text-sm">
                                {{ __('offices.status.' . \Illuminate\Support\Str::lower($office->status)) }}
                            </span></span>
                    </li>
                    <li class="flex items-center py-3">
                        <span>إنضم في</span>
                        <span class="mr-auto">{{ $office->created_at }}</span>
                    </li>
                </ul>
            </div>
            <!-- End of profile card -->
        </div>
        <!-- Right Side -->
        <div class="w-full md:w-9/12 mx-2">
            <!-- Profile tab -->
            <!-- About Section -->
            <div class="bg-white p-3 shadow-sm rounded-sm">
                <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8">
                    <span clas="text-green-500">
                        <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </span>
                    <span class="tracking-wide">معلومات عن {{ $office->name }}</span>
                </div>
                <div class="text-gray-700">
                    <p class="text-sm text-gray-500 hover:text-gray-600 leading-6">
                        {{ $office->description }}
                    </p>

                    <div class="grid md:grid-cols-2 text-sm">
                        <div class="grid grid-cols-2">
                            <div class="px-4 py-2 font-semibold">الإسم الكامل</div>
                            <div class="px-4 py-2">{{ $office->owner->name }}</div>
                        </div>
                        <div class="grid grid-cols-2">
                            <div class="px-4 py-2 font-semibold">الجنس</div>
                            <div class="px-4 py-2">{{ $gender }}</div>
                        </div>
                        <div class="grid grid-cols-2">
                            <div class="px-4 py-2 font-semibold">رقم الهاتف</div>
                            <div class="px-4 py-2">{{ $office->owner->phone_number }}</div>
                        </div>
                        <div class="grid grid-cols-2">
                            <div class="px-4 py-2 font-semibold">البريد الإلكتروني</div>
                            <div class="px-4 py-2">
                                <a class="text-blue-800" href="mailto:jane@example.com">{{ $office->owner->email }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of about section -->

            <div class="my-4"></div>

            <!-- Experience and education -->
            <div class="bg-white p-3 shadow-sm rounded-sm">

                <div class="grid grid-cols-2">
                    <div>
                        <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8 mb-3">
                            <span clas="text-green-500">
                                <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </span>
                            <span class="tracking-wide">الخبرة</span>
                        </div>
                        <ul class="list-inside space-y-2">
                            @forelse($experiences as $experience)
                            <li>
                                <div class="text-teal-600">{{ $experience['title'] }}</div>
                                <div class="text-gray-500 text-xs">{{ $experience['start_date'] }} - {{ $experience['end_date'] }}</div>
                            </li>
                            @empty
                            <p>-</p>
                            @endforelse
                        </ul>
                    </div>
                    <div>
                        <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8 mb-3">
                            <span clas="text-green-500">
                                <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path fill="#fff" d="M12 14l9-5-9-5-9 5 9 5z" />
                                    <path fill="#fff" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                                </svg>
                            </span>
                            <span class="tracking-wide">الدارسة</span>
                        </div>
                        <ul class="list-inside space-y-2">
                            @forelse($educations as $education)
                            <li>
                                <div class="text-teal-600">{{ $education['title'] }}</div>
                                <div class="text-gray-500 text-xs">{{ $education['start_date'] }} - {{ $education['end_date'] }}</div>
                            </li>
                            @empty
                            <p>-</p>
                            @endforelse
                        </ul>
                    </div>
                </div>
                <!-- End of Experience and education grid -->
            </div>
            <!-- End of profile tab -->

            <div class="my-4"></div>
            <!-- Friends card -->
            <div class="bg-white p-3 hover:shadow">
                <div class="flex items-center space-x-3 space-x-reverse font-semibold text-gray-900 text-xl leading-8 mb-4">
                    <span class="text-green-500">
                        <svg class="h-5 fill-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </span>
                    <span>موظفي المكتب</span>
                </div>
                <div class="grid grid-cols-6">
                    @foreach( $office->employees as $employee )
                    <div class="text-center my-2">
                        <img class="h-16 w-16 rounded-full mx-auto" src="{{ $employee->user->avatar_url() }}" alt="">
                        <a href="#" class="text-main-color">{{ $employee->user->name }}</a>
                    </div>
                    @endforeach
                </div>
            </div>
            <!-- End of friends card -->
            <div class="my-4"></div>
            <!-- Friends card -->
            <div class="bg-white p-3 hover:shadow">
                <div class="flex items-center space-x-3 space-x-reverse font-semibold text-gray-900 text-xl leading-8 mb-4">
                    <span class="text-green-500">
                        <svg class="h-5 fill-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </span>
                    <span>التقييمات</span>
                </div>
                <div class="grid grid-cols-1">
                    @if(!empty($orders->reviews))
                    @forelse( $orders->reviews as $review )
                    <article>
                        <div class="flex items-center mb-4 -space-x-4">
                            <img class="w-10 h-10 rounded-full ml-2" src="{{ $review->author->avatar_url() }}" alt="">
                            <div class="space-y-1 font-medium dark:text-white">
                                <p>
                                    {{ $review->author->name }} 
                                    <time datetime="{{ $review->author->created_at }}" class="block text-sm text-gray-500 dark:text-gray-400">إنضم في {{ $order->latestReview()->author->created_at }}</time>
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center mb-1">
                            @for ($i = 0; $i < $review->rating; $i++)
                            <svg aria-hidden="true" class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <title>{{ $i }} star</title>
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                            @endfor
                            @if(!empty($review->title))
                                <h3 class="ml-2 text-sm font-semibold text-gray-900 dark:text-white">$review->title</h3>
                            @endif
                        </div>
                        <footer class="mb-5 text-sm text-gray-500 dark:text-gray-400">
                            <p><time datetime="{{ $review->created_at }}">{{ $review->created_at }}</time></p>
                        </footer>
                       
                        <p class="mb-2 font-light text-gray-500 dark:text-gray-400">
                            {{ $review->review }}
                        </p>
                    </article>

                    @empty
                    <p>لاتوجد اي تقييمات حاليا.</p>
                    @endforelse
                    @endif

                </div>
            </div>
            <!-- End of friends card -->
        </div>
    </div>
</div>
@endsection