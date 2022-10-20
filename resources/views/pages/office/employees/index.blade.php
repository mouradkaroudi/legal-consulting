@extends('layouts.dashboard', ['pageTitle' => 'موظفين'])

@section('content')
<livewire:office.employees.list-employees :officeId="$officeId"/>
@endsection