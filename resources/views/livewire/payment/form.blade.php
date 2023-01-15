<form wire:submit.prevent="submit">
    {{ $this->form }}
    <x-filament::button 
        class="mt-4"
        :type="'submit'"
    >
        دفع
    </x-filament::button>
</div>
