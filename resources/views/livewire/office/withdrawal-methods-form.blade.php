<form wire:submit.prevent="submit">
    <div class="overflow-hidden shadow sm:rounded-md">
        <div class="space-y-6 bg-white px-4 py-5 sm:p-6">

            <div>
                <h3 class="text-lg font-medium leading-6 text-gray-900">{{ __('Withdrawal methods') }}</h3>
                <p class="mt-1 text-sm text-gray-600">{{ __('Information on ways to withdraw your profits from the site.') }}</p>
            </div>

            {{ $this->form }}
        </div>
        <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
            <x-filament-support::button :form="'submit'" :type="'submit'">
                {{ __('Save') }}
            </x-filament-support::button>
        </div>
    </div>
</form>