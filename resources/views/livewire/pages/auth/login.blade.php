<section class="bg-gray-50">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        @if(session()->has('status'))
        <div class="bg-green-50 border border-green-400 text-green-900 p-4 rounded-lg">
            {{ session()->get('status') }}
        </div>
        @endif
        <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
            <livewire:shared.site-logo />
        </a>
        <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                    {{ __('Log to your account') }}
                </h1>
                <livewire:auth.login :redirect="$redirect" />
            </div>
        </div>
    </div>
</section>