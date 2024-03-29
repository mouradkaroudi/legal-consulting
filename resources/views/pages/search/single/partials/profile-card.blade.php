<!-- Profile Card -->
<div class="bg-white p-3 border-t-4 border-green-700">
    <div class="mb-4 overflow-hidden">
        @if($office->image)
        <img class="h-auto w-full mx-auto" src="{{ asset('storage/' . $office->image) }}" alt="{{ $office->name }}">
        @else
        <div class="bg-gray-200 w-full text-center rounded-lg min-h-[180px]">
            <x-heroicon-o-photograph class="mx-auto top-2/4 translate-y-2/4 text-gray-400 w-24 h-24" />
        </div>
        @endif
    </div>

    <h1 class="text-gray-900 font-bold text-xl leading-8 my-1">{{ $office->name }}</h1>
    <div class="flex gap-4">
        @if(!empty($professionName))
        <span class="bg-blue-700 py-1 px-2 rounded text-white text-sm">{{ $professionName }}</span>
        @endif
    </div>
    @if($displayMessagingForm)
    <div class="mt-4">
        <livewire:messages.send-message :officeId="$office->id" />
    </div>
    @endif
    <ul class="bg-gray-100 text-gray-600 hover:text-gray-700 hover:shadow py-2 px-3 mt-3 divide-y rounded shadow-sm">
        <li class="flex gap-2 items-center py-3">
            <span>{{ __('Status') }}</span>
            <span>
                @if($office->status === 'available')
                <span class="rounded py-1 px-2 font-semibold text-sm bg-green-500 text-green-100 animate-pulse">
                    {{ __('Available') }}
                </span>
                @endif
                @if($office->status == 'busy')
                <span class="rounded py-1 px-2 font-semibold text-sm bg-orange-500 text-orange-100 animate-pulse">
                    {{ __('Busy') }}
                </span>
                @endif
                @if($office->status == 'closed')
                <span class="rounded  py-1 px-2 font-semibold text-sm bg-red-500 text-red-100 animate-pulse">
                    {{ __('Closed') }}
                </span>
                @endif
            </span>
        </li>
        <li class="flex gap-2 items-center py-3">
            <span>{{ __('Member since') }}</span>
            <span>{{ $office->created_at->translatedFormat(config('tables.date_format')) }}</span>
        </li>
    </ul>
</div>
<!-- End of profile card -->