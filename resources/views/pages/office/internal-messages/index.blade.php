@extends('layouts.dashboard', ['pageTitle' => __('Office messages')])

@section('content')
<livewire:office.internal-messages-table :officeId="$officeId"/>
@endsection