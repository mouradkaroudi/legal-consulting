@extends('layouts.front.index')
@section('content')
<div class="mx-auto max-w-screen-xl px-4 md:px-6 my-12">

    <div class="flex flex-col">
        <h2 class="text-xl font-bold mb-4 text-stone-600">
            بحث عن مقدم خدمة
        </h2>

        <livewire:front.widgets.listing.form />

    </div>

    <livewire:front.widgets.list-offices />

</div>
@endsection