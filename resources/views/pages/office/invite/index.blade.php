@extends('layouts.dashboard', ['pageTitle' => 'ارسال دعوة'])

@section('content')
<livewire:office.invite.send-invite-form :officeId="$office->id"/>
@endsection