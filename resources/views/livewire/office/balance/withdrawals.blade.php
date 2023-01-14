<form wire:submit.prevent="submit">
    <p>
    نرسل أرباحك إلى طرق السحب المتاحة في منطقتك.   
    </p>
    <div class="mb-4">
        {{ $this->form }}
    </div>
    
    <x-filament::button :type="'submit'" :form="'submit'">
        طلب سحب
    </x-filament::button>

</form>
