@extends('layouts.front.index', ['title' => $post->title])
@php
$sectionTextColor = setting('page_textcolor');
$sectionBgColor = setting('page_bgcolor');
@endphp
@section('content')
<div style="background-color: {{ $sectionBgColor }}; color: {{ $sectionTextColor }};">
    <div class="mx-auto max-w-screen-xl px-4 md:px-6 py-12">
        <h1 class="text-4xl text-center  font-bold mb-4">{{ $post->title }}</h1>
        <nav class="flex justify-center" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-3 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                <a href="#" class="inline-flex items-center text-sm font-medium ">
                    <x-heroicon-o-home class="w-4 h-4 mr-2 rtl:ml-2"/>
                    {{ __('Home') }}
                </a>
                </li>
                <li aria-current="page">
                <div class="flex items-center">
                    <x-heroicon-o-chevron-right class="w-4 h-4 "/>
                    <span class="mr-2 rtl:ml-2 text-sm font-medium">{{ $post->title }}</span>
                </div>
                </li>
            </ol>
        </nav>
    </div>
</div>
<div class="mx-auto max-w-screen-xl px-4 md:px-6 my-12">
    {!! $post->content !!}
</div>
@endsection