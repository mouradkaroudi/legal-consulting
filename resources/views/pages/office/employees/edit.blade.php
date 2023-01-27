@extends('layouts.dashboard', ['pageTitle' => __('Employees')])

@section('content')
<livewire:office.employees.form :DigitalOfficeEmployee="$DigitalOfficeEmployee"/>
@endsection