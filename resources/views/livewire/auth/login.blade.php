<form wire:submit.prevent="submit" class="space-y-8">
    {{ $this->form }}
    <div class="flex items-center justify-between">
        <div class="flex items-start">
            <div class="flex items-center h-5">
                <input id="remember" aria-describedby="remember" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300">
            </div>
            <div class="ml-3 rtl:mr-3 text-sm">
                <label for="remember" class="text-gray-500 dark:text-gray-300">{{ __('Remember me') }}</label>
            </div>
        </div>
        <x-filament::link class="text-sm" href="#">
            {{ __('Forgot your password ?') }}
        </x-filament::link>
    </div>

    <x-filament-support::button :form="'submit'" :type="'submit'" class="w-full">
        {{ __('Log In') }}
    </x-filament-support::button>
    <p class="text-sm font-light text-gray-500 dark:text-gray-400">
        {{ __('You dont have an account ?')}}
        <x-filament::link href="{{ route('auth.registration') }}">
            {{ __('Register') }}
        </x-filament::link>
    </p>
</form>