@extends('layouts.dashboard', ['pageTitle' => 'موظفين'])

@section('content')
<livewire:office.employees.form :DigitalOfficeEmployee="$DigitalOfficeEmployee"/>
@endsection