@extends('layouts.dashboard', ['pageTitle' => 'الرسائل'])

@section('content')
<livewire:office.messages-table :officeId="$officeId"/>
@endsection