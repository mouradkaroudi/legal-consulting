@extends('layouts.front.index')
@section('content')
<div class="max-w-screen-xl px-4 md:px-6 mx-auto my-12">
    <div class="mb-8">
        <h1 class="text-4xl font-bold mb-4">مرحبا بك في مشروع المحامي</h1>
        <p class="text-xl">سجل حساب جديد و استفد(ي) من خدمات الموقع المتعددة</p>
    </div>
    @if(!empty($invite))
    <div class="p-4 mb-4 text-sm text-blue-700 bg-blue-100 rounded-lg dark:bg-blue-200 dark:text-blue-800" role="alert">
    سجل حساب للإنظمام لمكتب {{ $office->name }}
    </div>
    @endif
    <div class="grid grid-cols-2 gap-6">
        <div>
            <livewire:auth.registration :inviteToken="$invite?->token" :email="$invite?->email"/>
        </div>
    </div>
</div>
@endsection