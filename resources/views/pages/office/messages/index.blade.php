@extends('layouts.dashboard', ['pageTitle' => __('Messages')])

@section('content')
<livewire:office.messages-table :officeId="$officeId"/>
@endsection