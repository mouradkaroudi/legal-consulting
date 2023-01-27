@extends('layouts.front.index')
@section('content')
<div class="bg-gray-900">
    <div class="mx-auto max-w-screen-xl px-4 md:px-6 py-12">
        <h1 class="text-3xl text-white font-bold">{{ $service->name }}</h1>
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center -space-x-1 md:-space-x-3">
                <li class="inline-flex items-center">
                <a href="#" class="inline-flex items-center text-sm font-medium text-white hover:text-gray-50">
                    <svg class="w-4 h-4 ml-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                    {{ __('Home') }}
                </a>
                </li>
                <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-50" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                    <span class="ml-1 text-sm font-medium text-gray-50 md:ml-2 ">{{ $service->name }}</span>
                </div>
                </li>
            </ol>
        </nav>
    </div>
</div>
<div class="mx-auto max-w-screen-xl px-4 md:px-6 my-12">

    <livewire:front.widgets.list-offices :service="$service"/>

</div>
@endsection