<form wire:submit.prevent="submit">
    <div class="mb-4 w-full bg-gray-50 rounded-lg border border-gray-200">
        <div class="bg-white rounded-t-lg">
        {{ $this->replyForm }}
        </div>
        <div class="flex justify-between items-center py-2 px-3 border-t">
            <x-filament-support::button :type="'submit'">
            {{ __('Send') }}
            </x-filament-support::button>
            <div class="flex gap-2 pl-0 space-x-1 sm:pl-2">
                <livewire:messages.upload-attachments />
                <livewire:messages.create-meeting />
            </div>
        </div>
    </div>
</form>
<p class="ml-auto text-xs text-gray-500">تذكر أن المساهمات في هذا الموضوع يجب أن تتبع <a href="#" class="text-blue-600 hover:underline">إرشادات المجتمع</a>.</p>