@extends('layouts.dashboard', ['pageTitle' => 'لوحة التحكم'])

@section('content')
  <livewire:office.office-stats />
  <livewire:office.messages-table/>
@endsection