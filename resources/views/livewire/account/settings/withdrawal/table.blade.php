<div class="overflow-hidden shadow sm:rounded-md">
    <div class="space-y-6 bg-white px-4 py-5 sm:p-6">

        <div>
            <h3 class="text-lg font-medium leading-6 text-gray-900">{{ __('Withdrawal methods') }}</h3>
            <p class="mt-1 text-sm text-gray-600">{{ __('Information on ways to withdraw your profits from the site.') }}</p>
        </div>
        {{ $this->table }}
    </div>
</div>