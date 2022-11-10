<form wire:submit.prevent="submit">
    {{ $this->form }}
    <div class="mt-4">
        <x-filament-support::button type="submit">
            تعديل
        </x-filament-support::button>
    </div>
</form>