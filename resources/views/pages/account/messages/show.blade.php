@extends('layouts.account', ['title' => 'رسالة'])

@section('content')
<div class="mx-auto max-w-screen-xl flex flex-col">
    <livewire:messages.widgets.header-bar 
    :thread="$thread" 
    :showCloseConversation="true"
    :viewer="$viewer"
    />
    <div class="mt-8">
        <div class="divide-y-2">
            @each('messenger.partials.messages', $thread->messages, 'message')
        </div>
    </div>
    @if(!$thread->closed_at)
        <livewire:messages.widgets.reply-form :thread="$thread"/>
    @else
        <x-alert>
            تم غلق المحادثة من طرف {{ \App\Models\User::find($thread->closed_by)->name }}
        </x-alert>
    @endif
</div>

@stop