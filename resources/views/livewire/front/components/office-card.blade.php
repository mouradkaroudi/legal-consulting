<a href="/search/office/{{ $office->id }}" class="flex flex-col items-center p-4 border sm:p-6 rounded-xl">
    <img class="object-cover w-full rounded-xl aspect-square" src="{{ asset('storage/' . $office->image) }}" alt="">

    <h1 class="mt-4 text-xl font-bold text-gray-700 capitalize">{{ $office->name }}</h1>

    <p class="mt-2 text-gray-500 capitalize dark:text-gray-300">Full stack developer</p>

</a>