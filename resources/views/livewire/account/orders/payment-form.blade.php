<div>
    <form wire:submit.prevent="submit">
        <div class="mb-4">
            {{ $this->form }}
        </div>
        <x-filament::button wire:target="submit" type="submit">دفع</x-filament::button>
    </form>
</div>
