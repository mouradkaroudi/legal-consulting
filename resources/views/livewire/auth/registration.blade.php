<form wire:submit.prevent="submit" class="space-y-8">
    {{ $this->form }}
    <x-filament-support::button :form="'submit'" :type="'submit'" class="w-full">
    إنشاء حساب  
    </x-filament-support::button>
        
    </button>
    <p class="text-sm font-light text-gray-500 dark:text-gray-400">
        لديك حساب? <a href="{{ route('auth.login') }}" class="font-medium text-primary-600 hover:underline dark:text-primary-500">سجل الدخول</a>
    </p>
    <!--  -->
</form>