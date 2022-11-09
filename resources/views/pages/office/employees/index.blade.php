@extends('layouts.dashboard', ['pageTitle' => 'موظفين'])

@section('actions')
<div class="flex flex-wrap items-center gap-4 justify-start shrink-0">
</div>
@endsection

@section('content')
<livewire:office.employees.list-employees :officeId="$officeId"/>
@endsection