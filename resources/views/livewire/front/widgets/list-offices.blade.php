<div>
    <form method="GET" wire:submit.prevent="submit">
    <div class="p-6 bg-white rounded-xl border border-gray-300">
        {{ $this->mainForm }}
        
        <div x-data="{ expanded: false }">
            <x-filament-support::button :color="'secondary'" class="mt-4" @click="expanded = ! expanded">
                بحث متقدم
            </x-filament-support::button>
        
            <div class="mt-4" x-show="expanded" hidden x-collapse>
                {{ $this->locationForm }}
            </div>
        </div>

        <div class="mt-3 pt-2 border-t">
            <x-filament-support::button :type="'submit'">بحث</x-filament-support::button>
        </div>

    </div>
    </form>
    <div class="grid grid-cols-1 gap-8 mt-8 xl:mt-16 md:grid-cols-2 xl:grid-cols-3">
        @foreach ($offices as $office)
        <livewire:front.components.office-card :office="$office"/>
        @endforeach
    </div>
</div>