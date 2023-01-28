@extends('layouts.front.index', ['title' => $service->name])
@section('content')
<div class="bg-green-900">
    <div class="mx-auto max-w-screen-xl px-4 md:px-6 py-12">
        <h1 class="text-2xl text-white font-bold mb-4">{{ $service->name }}</h1>
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-3 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                <a href="#" class="inline-flex items-center text-sm font-medium text-white hover:text-gray-50">
                    <x-heroicon-o-home class="w-4 h-4 mr-2 rtl:ml-2"/>
                    {{ __('Home') }}
                </a>
                </li>
                <li aria-current="page">
                <div class="flex items-center">
                    <x-heroicon-o-chevron-right class="w-4 h-4 text-gray-50"/>
                    <span class="mr-2 rtl:ml-2 text-sm font-medium text-gray-50">{{ $service->name }}</span>
                </div>
                </li>
            </ol>
        </nav>
    </div>
</div>
<div class="mx-auto max-w-screen-xl px-4 md:px-6 my-12">
    <livewire:front.widgets.list-offices :service="$service" :profession="$profession"/>
</div>
@endsection