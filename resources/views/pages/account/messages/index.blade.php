@extends('layouts.account', ['title' => __('Messages')])

@section('content')
    @include('messenger.partials.flash')

    <livewire:account.messages-table />
@stop
