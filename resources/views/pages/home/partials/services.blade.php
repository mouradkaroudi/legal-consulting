<section class="relative px-4 py-16 mx-auto overflow-hidden sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20">
    <div class="container px-6 py-10 mx-auto">
        <div class="mb-8 text-center">
            <h1 class="text-3xl font-semibold text-gray-800 capitalize lg:text-4xl">
                {{ __('Explore our services') }}
            </h1>

            <p class="mt-4 text-xl text-gray-500 xl:mt-6 dark:text-gray-300">
                {{ __("Looking for legal help should not be a daunting task") }}، <br/> 
                {{ __("It's easier than ever to connect with a qualified legal professional")}}.
            </p>
        </div>

        <livewire:front.widgets.list-categories />

    </div>
</section>