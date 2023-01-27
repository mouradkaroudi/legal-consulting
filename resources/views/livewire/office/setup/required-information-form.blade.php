<div>
    <form wire:submit.prevent="submit">
        {{ $this->form }}
        <x-filament::button
            class="mt-4"
            :type="'submit'"
        >
            {{ __('Continue') }}
        </x-filament::button>
    </form>
</div>
