@extends('layouts.account', ['title' => __('Message')])

@section('content')
<div class="mx-auto max-w-screen-xl flex flex-col">
    <livewire:account.widgets.messages.header :thread="$thread" :showCloseConversation="true" />
    <div class="mt-8">
        <div class="divide-y-2">
            @each('messenger.partials.messages', $thread->messages, 'message')
        </div>
    </div>
    @if(!$thread->closed_at)
    <livewire:messages.widgets.reply-form :thread="$thread" />
    @else
    <x-alert>
        {{ __('The conversation has been closed by :username', ['username' => \App\Models\User::find($thread->closed_by)->name]) }}
    </x-alert>
    @endif
</div>

@stop