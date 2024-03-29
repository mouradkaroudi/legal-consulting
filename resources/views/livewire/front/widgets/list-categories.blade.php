<div class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-3">
    @foreach($services as $service)
    <a href="{{ route('search.listing', ['service' => $service->slug]) }}" class="block space-y-3 border rounded-lg p-4 bg-white hover:border-gray-300">
        <h3 class="text-2xl font-semibold text-gray-700 capitalize dark:text-white">{{ $service->name }}</h3>

        <span href="" class="inline-flex items-center -mx-1 text-blue-500 capitalize transition-colors duration-300 transform dark:text-blue-400 hover:underline hover:text-blue-600 dark:hover:text-blue-500">
            <span class="mx-1">{{ __('Browse services') }}</span>
            <svg class="w-4 h-4 mx-1 rtl:-scale-x-100" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
            </svg>
        </span>
    </a>
    @endforeach
</div>