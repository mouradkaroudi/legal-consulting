<form wire:submit.prevent="submit">
    <div class="overflow-hidden shadow sm:rounded-md">
        <div class="bg-white px-4 py-5 sm:p-6">
            {{ $this->form }}
        </div>
        <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
            <x-filament-support::button :form="'submit'" :type="'submit'">حفظ</x-filament-support::button>
        </div>
    </div>
</form>
