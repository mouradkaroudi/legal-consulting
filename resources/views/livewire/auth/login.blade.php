<form wire:submit.prevent="submit" class="space-y-8">
    {{ $this->form }}
    <div class="flex items-center justify-between">
        <div class="flex items-start">
            <div class="flex items-center h-5">
                <input id="remember" aria-describedby="remember" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300">
            </div>
            <div class="mr-3 text-sm">
                <label for="remember" class="text-gray-500 dark:text-gray-300">{{ __('Remember me') }}</label>
            </div>
        </div>
        <a href="#" class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-500">{{ __('Forgot your password ?') }}</a>
    </div>

    <x-filament-support::button :form="'submit'" :type="'submit'" class="w-full">
        {{ __('Log In') }}
    </x-filament-support::button>
    <p class="text-sm font-light text-gray-500 dark:text-gray-400">
        {{  __('You dont have an account ?')}}
        <a href="{{ route('auth.registration') }}" class="font-medium text-primary-600 hover:underline dark:text-primary-500">{{ __('Register') }}</a>
    </p>
</form>