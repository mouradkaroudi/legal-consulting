<form wire:submit.prevent="submit">
    {{ $this->form }}
    <div class="mt-4">
        <x-filament-support::button :form="'submit'" :type="'submit'">
            حفظ
        </x-filament-support::button>
    </div>
</form>