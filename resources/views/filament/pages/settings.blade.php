<form wire:submit.prevent="submit" class="space-y-6">
    {{ $this->form }}
    <div class="flex flex-wrap items-center gap-4 justify-start">
        <x-filament::button :type="'submit'">
            {{ __('Save') }}
        </x-filament::button>
    </div>
</form>