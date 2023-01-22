@extends('layouts.dashboard', ['pageTitle' => 'موظفين'])
@section('content')
<div class="mb-8">
    <livewire:office.employees.list-employees :officeId="$officeId" />
</div>
<livewire:office.employees.invites-table />
@endsection