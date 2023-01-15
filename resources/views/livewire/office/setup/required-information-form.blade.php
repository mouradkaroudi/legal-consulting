<div>
    <form wire:submit.prevent="submit">
        {{ $this->form }}
        <x-filament::button
            class="mt-4"
            :type="'submit'"
        >
            أكمل
        </x-filament::button>
    </form>
</div>
