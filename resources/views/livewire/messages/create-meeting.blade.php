<x-filament::modal>
    <x-slot name="trigger">
        <x-filament::button :icon="'heroicon-o-video-camera'" :labelSrOnly="true" :color="'secondary'" :type="'button'" x-on:click="isOpen = true">محادثة</x-filament::button>
    </x-slot>

    <x-slot name="header">
        {{ __('Create a meeting') }}
    </x-slot>
    <x-alert>
        احرص على استعمال موقع القانوني في معاملاتك المالية. <a href="#" class="underline text-bule-700">أعرف كيف نضمن حقوقك.</a>

    </x-alert>
    <p class="text-sm text-gray-700">
        {{ __('Use one of the virtual meetings services to facilitate communication.') }}
    </p>
    <div class="grid gap-4">
        <a href="https://www.microsoft.com/fr/microsoft-teams" class="p-4 border items-center justify-between rounded-lg flex hover:shadow-sm hover:-translate-y-1 duration-300">
            <span class="font-bold text-base">Microsoft Teams</span>
            <x-heroicon-o-external-link class="w-4 h-4 text-gray-400" />
        </a>
        <a href="https://www.wibox.fr/" class="p-4 border items-center justify-between rounded-lg flex hover:shadow-sm hover:-translate-y-1 duration-300">
            <span class="font-bold text-base">Wibox</span>
            <x-heroicon-o-external-link class="w-4 h-4 text-gray-400" />
        </a>
        <a href="#" class="p-4 border items-center justify-between rounded-lg flex hover:shadow-sm hover:-translate-y-1 duration-300">
            <span class="font-bold text-base">Zoom</span>
            <x-heroicon-o-external-link class="w-4 h-4 text-gray-400" />
        </a>
        <a href="https://meet.google.com/" target="_blank" class="p-4 border items-center justify-between rounded-lg flex hover:shadow-sm hover:-translate-y-1 duration-300">
            <span class="font-bold text-base">Google Meet</span>
            <x-heroicon-o-external-link class="w-4 h-4 text-gray-400" />
        </a>
    </div>
</x-filament::modal>