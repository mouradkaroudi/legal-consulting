<form wire:submit.prevent="submit">
    <p>
        {{ __('We send your revenues to the withdrawal methods available in your region.') }}
    </p>
    <div class="mb-4">
        {{ $this->form }}
    </div>

    <x-filament::button :type="'submit'" :form="'submit'">
        {{ __('Request withdrawal') }}
    </x-filament::button>

</form>