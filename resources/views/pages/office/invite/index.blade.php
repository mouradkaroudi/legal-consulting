@extends('layouts.dashboard', ['pageTitle' => 'ارسال دعوة'])

@section('content')
<x-filament-support::grid class="gap-6" :default="2">
    <livewire:office.invites.table/>
    <livewire:office.invite.send-invite-form :officeId="$office->id"/>
</x-filament-support::grid>
@endsection