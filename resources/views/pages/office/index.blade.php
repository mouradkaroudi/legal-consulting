@extends('layouts.dashboard', ['pageTitle' => __('Dashboard')])

@section('content')
<livewire:office.office-stats />
<div class="my-6"></div>
<livewire:office.messages-table />
@endsection