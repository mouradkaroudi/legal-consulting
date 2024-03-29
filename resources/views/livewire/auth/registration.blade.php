<form wire:submit.prevent="submit" class="space-y-8">
    {{ $this->form }}
    <x-filament-support::button :form="'submit'" :type="'submit'" class="w-full">
        {{ __('Create an account') }}  
    </x-filament-support::button>
        
    </button>
    <p class="text-sm font-light text-gray-500 dark:text-gray-400">
        {{ __('Your already have an account ?') }}
        <a href="{{ route('auth.login') }}" class="font-medium text-primary-600 hover:underline dark:text-primary-500">
            {{ __('Log In') }}
        </a>
    </p>
    <!--  -->
</form>