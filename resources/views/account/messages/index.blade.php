@extends('layouts.account', ['title' => 'الرسائل'])

@section('content')
    @include('messenger.partials.flash')

    <livewire:account.messages-table />
@stop
