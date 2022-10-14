<div>
    @auth()
    <form method="POST" wire:submit.prevent="send">
        {{ $this->form }}
        <x-filament-support::button type="submit" class="w-full mt-4">
            أرسل
        </x-filament-support::button>
    </form>
    @else
    <a href="/login?redirect={{ Request::url() }}" class="inline-flex items-center justify-center py-1 gap-1 font-medium rounded-lg border transition-colors focus:outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset min-h-[2.25rem] px-4 text-sm text-white shadow focus:ring-white border-transparent bg-primary-600 hover:bg-primary-500 focus:bg-primary-700 focus:ring-offset-primary-700 w-full">
        تواصل معه
    </a>
    @endauth
</div>