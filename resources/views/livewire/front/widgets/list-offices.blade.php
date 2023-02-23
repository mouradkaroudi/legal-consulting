<div>
    <form method="GET">
        <div class="p-6 bg-white rounded-xl border border-gray-300">
            {{ $this->mainForm }}

            <div x-data="{ expanded: false }">
                <x-filament-support::button :color="'secondary'" class="mt-4" @click="expanded = ! expanded">
                    {{ __('Advanced search') }}
                </x-filament-support::button>

                <div class="mt-4" x-show="expanded" hidden x-collapse>
                    {{ $this->locationForm }}
                </div>
            </div>

        </div>
    </form>
    <div class="mt-8">

        <p class="mb-4">{{ __('We found about') }} <span class="font-bold">{{ $offices->count() }}</span> {{ __('Offices') }}.</p>

        <div class="grid grid-cols-1 gap-8 md:grid-cols-2 xl:grid-cols-3">
            @foreach ($offices as $office)
            <livewire:front.components.office-card :office="$office" :wire:key="$office->id" />
            @endforeach
        </div>
    </div>
</div>