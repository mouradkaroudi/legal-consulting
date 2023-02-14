<!-- About Section -->
<div class="bg-white p-3 shadow-sm rounded-sm">
    <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8">
        <span clas="text-green-500">
            <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
        </span>
        <span class="tracking-wide">{{ __('About :Name', ['Name' => $office->name]) }}</span>
    </div>
    <div class="text-gray-700">
        <p class="text-sm text-gray-500 hover:text-gray-600 leading-6">
            {{ $office->description }}
        </p>

        <div class="grid md:grid-cols-2 text-sm">
            <div class="grid grid-cols-2">
                <div class="px-4 py-2 font-semibold">{{ __('Full name') }}</div>
                <div class="px-4 py-2">{{ $office->owner->name }}</div>
            </div>
            <div class="grid grid-cols-2">
                <div class="px-4 py-2 font-semibold">{{ __('Email address') }}</div>
                <div class="px-4 py-2">
                    <a class="text-blue-800" href="mailto:{{ $office->owner->email }}">{{ $office->owner->email }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End of about section -->