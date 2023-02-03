@extends('layouts.front.index')
@section('content')
@include('pages.home.partials.hero')
@include('pages.home.partials.services')
<div class="bg-green-900">
    <div class="mx-auto max-w-7xl py-12 px-4 sm:px-6 lg:flex lg:items-center lg:justify-between lg:py-16 lg:px-8">
        <h2 class="text-3xl font-bold tracking-tight text-white sm:text-4xl">
            <span class="block">{{ __('Are you ready to join us?') }}</span>
            <span class="block">{{ __('Start by opening your account on :sitename website now', ['sitename' =>  setting('general_settings_site_name_' . app()->getLocale())]) }}</span>
        </h2>
        <div class="mt-8 flex lg:mt-0 lg:flex-shrink-0 space-x-4 space-x-reverse">
            <div class="inline-flex rounded-md shadow">
                <a href="{{ route('auth.registration') }}" class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-5 py-3 text-base font-medium text-white hover:bg-indigo-700">
                    {{ __('Sign up now') }}
                </a>
            </div>
            <div class="ml-3 inline-flex rounded-md shadow">
                <a href="#" class="inline-flex items-center justify-center rounded-md border border-transparent bg-white px-5 py-3 text-base font-medium text-indigo-600 hover:bg-indigo-50">
                    {{ __('Learn more') }}
                </a>
            </div>
        </div>
    </div>
</div>
<livewire:shared.widgets.faq />
@endsection