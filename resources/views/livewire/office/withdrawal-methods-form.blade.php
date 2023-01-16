<form wire:submit.prevent="submit">
    <div class="overflow-hidden shadow sm:rounded-md">
        <div class="space-y-6 bg-white px-4 py-5 sm:p-6">

            <div>
                <h3 class="text-lg font-medium leading-6 text-gray-900">طريقة السحب</h3>
                <p class="mt-1 text-sm text-gray-600">معلومات عن طرق سحب ارباحك من الموقع.</p>
            </div>

            {{ $this->form }}
        </div>
        <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
            <x-filament-support::button :form="'submit'" :type="'submit'">حفظ</x-filament-support::button>
        </div>
    </div>
</form>