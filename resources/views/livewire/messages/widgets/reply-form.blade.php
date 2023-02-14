<div x-data="{showUpload:false}">
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
                    <x-filament::button type="button" x-on:click="showUpload = !showUpload">
                        {{ __('Upload file') }}
                    </x-filament::button>
                    <livewire:messages.create-meeting />
                </div>
            </div>
            <div class="p-4" x-show="showUpload" x-cloak>
                {{ $this->uploadForm }}
            </div>
        </div>
        <p class="ml-auto text-xs text-gray-500">{{ __("Please be advised that all conversations should adhere to the website's terms of use") }}.</p>
    </form>
</div>