<div>
    <form wire:submit.prevent="submit">
        {{ $this->form }}
        <div class="mt-4">
            <x-filament-support::button type="submit">
            ادفع الآن
            </x-filament-support::button>
        </div>
    </form>
</div>
