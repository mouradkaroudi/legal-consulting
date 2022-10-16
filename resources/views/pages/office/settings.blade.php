@extends('layouts.dashboard', ['pageTitle' => 'إعدادات المكتب'])

@section('content')
<livewire:office.edit-settings :digitalOffice="$digitalOffice"/>
@endsection