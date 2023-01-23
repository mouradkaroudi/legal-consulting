@extends('layouts.front.index')
@section('content')
@include('pages.home.partials.hero')
@include('pages.home.partials.services')
<div class="bg-green-900">
    <div class="mx-auto max-w-7xl py-12 px-4 sm:px-6 lg:flex lg:items-center lg:justify-between lg:py-16 lg:px-8">
        <h2 class="text-3xl font-bold tracking-tight text-white sm:text-4xl">
            <span class="block">هل أنت جاهز للإنظمام لنا ؟</span>
            <span class="block">إبدأ بفتح حسابك على موقع المحامي الآن</span>
        </h2>
        <div class="mt-8 flex lg:mt-0 lg:flex-shrink-0 space-x-4 space-x-reverse">
            <div class="inline-flex rounded-md shadow">
                <a href="#" class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-5 py-3 text-base font-medium text-white hover:bg-indigo-700">سجِل الآن</a>
            </div>
            <div class="ml-3 inline-flex rounded-md shadow">
                <a href="#" class="inline-flex items-center justify-center rounded-md border border-transparent bg-white px-5 py-3 text-base font-medium text-indigo-600 hover:bg-indigo-50">اعرف اكثر</a>
            </div>
        </div>
    </div>
</div>
@include('pages.home.partials.faq')
@endsection