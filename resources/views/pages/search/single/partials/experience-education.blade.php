<div class="bg-white p-3 shadow-sm rounded-sm">

    <div class="grid md:grid-cols-2">
        <div>
            <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8 mb-3">
                <span clas="text-green-500">
                    <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </span>
                <span class="tracking-wide">{{ __('Experience') }}</span>
            </div>
            <ul class="list-inside space-y-2">
                @forelse($experiences as $experience)
                <li>
                    <div class="text-teal-600">{{ $experience['title'] }}</div>
                    <div class="text-gray-500 text-xs">{{ $experience['start_date'] }} - {{ $experience['end_date'] }}</div>
                </li>
                @empty
                <p>-</p>
                @endforelse
            </ul>
        </div>
        <div>
            <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8 mb-3">
                <span clas="text-green-500">
                    <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path fill="#fff" d="M12 14l9-5-9-5-9 5 9 5z" />
                        <path fill="#fff" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                    </svg>
                </span>
                <span class="tracking-wide">{{ __('Education') }}</span>
            </div>
            <ul class="list-inside space-y-2">
                @forelse($educations as $education)
                <li>
                    <div class="text-teal-600">{{ $education['title'] }}</div>
                    <div class="text-gray-500 text-xs">{{ $education['start_date'] }} - {{ $education['end_date'] }}</div>
                </li>
                @empty
                <p>-</p>
                @endforelse
            </ul>
        </div>
    </div>
</div>