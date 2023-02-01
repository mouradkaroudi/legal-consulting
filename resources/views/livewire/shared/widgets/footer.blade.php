<footer class="border-t bg-gray-900 border-gray-300">
    <div class="px-4 mx-auto overflow-hidden sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 sm:p-6">
        <div class="md:flex md:justify-between">
            <div class="mb-6 md:mb-0">
                <a href="#" class="flex items-center">
                    <img class="w-28" src="{{ asset('storage/' . setting('general_settings_site_logo')) }}" alt="">
                </a>
            </div>

            <div class="grid grid-cols-2 gap-8 sm:gap-6 sm:grid-cols-3">
                @foreach($menu as $menuItem)
                <div>
                    <h2 class="text-white mb-6 text-sm font-semibold uppercase">{{ $menuItem['label'] }}</h2>
                    @if(!empty($menuItem['children']))
                    <ul class="text-white ">
                        @foreach($menuItem['children'] as $itemChildren)
                        <li class="mb-4">
                            <a href="{{ $itemChildren['data']['url'] }}" class="hover:underline">
                                {{ $itemChildren['label'] }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                    @endif
                </div>
                @endforeach
            </div>

        </div>
        <hr class="my-6 border-gray-200 sm:mx-auto lg:my-8">
        <div class="sm:flex sm:items-center sm:justify-between">
            <span class="text-sm text-gray-500 sm:text-center">
                © {{ now()->year }} <a href="#" class="hover:underline">{{ setting('general_settings_site_name_' . app()->getLocale()) }}</a>. {{ __('All rights reserved') }}.
            </span>
            <div class="flex mt-4 space-x-6 rtl:space-x-reverse sm:justify-center sm:mt-0">
                @if($socialLinks)
                @foreach($socialLinks as $socialLink)
                <a href="{{ $socialLink->link }}" target="_blank" class="text-gray-500 hover:text-gray-400 ">
                    <x-dynamic-component component="social-icons.{{ $socialLink->platform }}" class="w-5 h-5" />
                </a>
                @endforeach
                @endif
            </div>
        </div>
    </div>
</footer>