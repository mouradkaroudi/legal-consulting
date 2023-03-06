@extends('layouts.dashboard', ['pageTitle' => __('Office messages')])

@section('content')
<div class="mx-auto max-w-screen-xl flex flex-col">
    <livewire:office.widgets.internal-messages.header
    :thread="$thread" 
    :showCloseConversation="true"
    :showCreateOffer="$showCreateOffer"
    />
    <div class="mt-8">
        <div class="divide-y-2">
            @each('messenger.partials.messages', $thread->messages, 'message')
        </div>
    </div>
    <livewire:messages.widgets.reply-form :thread="$thread"/>
</div>

@stop