<form wire:submit.prevent="submit">
    <div class="shadow sm:overflow-hidden sm:rounded-md">
       <div class="space-y-6 bg-white px-4 py-5 sm:p-6">
            {{ $this->form }}
        </div>
        <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
            <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-blue-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">حفظ</button>
        </div>
    </div>
</form>
