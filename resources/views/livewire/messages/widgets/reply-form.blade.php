<form method="POST" wire:submit.prevent="submit">
    {{ csrf_field() }}
    <div class="mb-4 w-full bg-gray-50 rounded-lg border border-gray-200">
        <div class="bg-white rounded-t-lg">
        {{ $this->form }}
        </div>
        <div class="flex justify-between items-center py-2 px-3 border-t">
            <button type="submit" class="inline-flex items-center py-2.5 px-4 font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200">
                أرسل
            </button>
            <div class="flex pl-0 space-x-1 sm:pl-2">
                <button type="button" class="inline-flex justify-center p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Attach file</span>
                </button>
                <button type="button" class="inline-flex justify-center p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Upload image</span>
                </button>
            </div>
        </div>
    </div>
</form>
<p class="ml-auto text-xs text-gray-500">تذكر أن المساهمات في هذا الموضوع يجب أن تتبع <a href="#" class="text-blue-600 hover:underline">إرشادات المجتمع</a>.</p>