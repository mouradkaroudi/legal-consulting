<div class="hidden sm:flex sm:items-center sm:ml-6">
    <x-dropdown width="48">
        <x-slot name="trigger">
            <x-filament::button @click="isOpen = !isOpen" aria-expanded="false" aria-haspopup="true">
                إختر اللغة
            </x-filament::button>
        </x-slot>
        <x-slot name="content">
            <x-dropdown-link :href="request()->url() . '?language=ar'">
                العربية
            </x-dropdown-link>
            <x-dropdown-link :href="request()->url() . '?language=en'">
                English
            </x-dropdown-link>
        </x-slot>
    </x-dropdown>
</div>