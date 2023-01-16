{{-- https://tailwindui.com/components/application-ui/forms/form-layouts#component-d45285168387e95ed939cc1a91e8e19c --}}
<form wire:submit.prevent="submit">
    <div class="shadow sm:overflow-hidden sm:rounded-md">
        <div class="space-y-6 bg-white px-4 py-5 sm:p-6">
            <div>
                <h3 class="text-lg font-medium leading-6 text-gray-900">معلومات المكتب</h3>
                <p class="mt-1 text-sm text-gray-600">معلومات عن المكتب و نبذة عنه</p>
            </div>
            {{ $this->form }}
        </div>
        <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
            <x-filament-support::button :form="'submit'" :type="'submit'">حفظ</x-filament-support::button>
        </div>
    </div>
</form>