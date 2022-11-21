<a href="{{ route('search.office', ['digitalOffice' => $office->id]) }}" class="block border rounded-xl bg-white">
    @if($office->image)
    <img class="object-cover w-full rounded-xl rounded-bl-none rounded-br-none aspect-square" src="{{ asset('storage/' . $office->image) }}" alt="">
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