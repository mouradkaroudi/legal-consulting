@php
$link = route('search.office', [
    'service' => $office->service,
    'profession' => $office->profession,
    'digitalOffice' => $office->id, 
    'name' => $office->url_name
]);
@endphp
<a href="{{ $link }}" class="relative block border rounded-xl bg-white">
    <div class="absolute top-0 left-0 rtl:right-0 p-3">
        @if($office->status === 'AVAILABLE')
            <span class="rounded-full p-1 px-4 font-semibold text-sm bg-green-500 text-green-100 animate-pulse">
                {{ __('Available') }}
            </span>
        @else
            <span class="rounded-full p-1 px-4 font-semibold text-sm bg-red-500 text-red-100">
                {{ __('Busy') }}
            </span>
        @endif
    </div>
    @if($office->image)
    <img class="object-cover w-full rounded-xl rounded-bl-none rounded-br-none aspect-square max-h-56" src="{{ asset('storage/' . $office->image) }}" alt="">
    @else
    <div class="bg-gray-200 w-full text-center rounded-lg rounded-bl-none rounded-br-none h-[180px]">
        <x-heroicon-o-photograph class="mx-auto top-2/4 translate-y-2/4 text-gray-400 w-24 h-24"/>
    </div>
    @endif
    <div class="p-3">
    <h1 class="text-xl font-bold text-blue-700 capitalize">{{ $office->name }}</h1>

    <p class="mt-2 text-gray-500 capitalize dark:text-gray-300">{{ $office->profession?->name }}</p>
    </div>

</a>