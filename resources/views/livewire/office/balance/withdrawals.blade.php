<form wire:submit.prevent="submit">
    <div class="mb-4">
        {{ $this->form }}
    </div>
    
    <x-filament::button :type="'submit'" :form="'submit'">
        طلب سحب
    </x-filament::button>

</form>
