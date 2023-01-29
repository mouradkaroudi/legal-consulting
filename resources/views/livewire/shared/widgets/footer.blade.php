<footer class="border-t bg-gray-900 border-gray-300">
    <div class="px-4 mx-auto overflow-hidden sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 sm:p-6">
        <div class="md:flex md:justify-between">
            <div class="mb-6 md:mb-0">
                <a href="#" class="flex items-center">
                    <span class="self-center text-2xl font-semibold whitespace-nowrap">مشروع المحامي</span>
                </a>
            </div>
            <div class="grid grid-cols-2 gap-8 sm:gap-6 sm:grid-cols-3">
                <div>
                    <h2 class="mb-6 text-sm font-semibold uppercase">روابط</h2>
                    <ul class="text-gray-600 ">
                        <li class="mb-4">
                            <a href="#" class="hover:underline">رابط</a>
                        </li>
                        <li>
                            <a href="#" class="hover:underline">رابط</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h2 class="mb-6 text-sm font-semibold uppercase">تابعنا</h2>
                    <ul class="text-gray-600 ">
                        <li class="mb-4">
                            <a href="#" class="hover:underline ">رابط</a>
                        </li>
                        <li>
                            <a href="#" class="hover:underline">رابط</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h2 class="mb-6 text-sm font-semibold uppercase">الخصوصية</h2>
                    <ul class="text-gray-600 ">
                        <li class="mb-4">
                            <a href="#" class="hover:underline">رابط</a>
                        </li>
                        <li>
                            <a href="#" class="hover:underline">رابط</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <hr class="my-6 border-gray-200 sm:mx-auto lg:my-8">
        <div class="sm:flex sm:items-center sm:justify-between">
            <span class="text-sm text-gray-500 sm:text-center">© 2022 <a href="#" class="hover:underline">{{ setting('general_settings_site_name_' . app()->getLocale()) }}</a>. {{ __('All rights reserved') }}.
            </span>
            <div class="flex mt-4 space-x-6 rtl:space-x-reverse sm:justify-center sm:mt-0">
                @if($socialLinks)
                @foreach($socialLinks as $socialLink)
                <a href="#" class="text-gray-500 hover:text-gray-400 ">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">{{ $socialLink->label }}</span>
                </a>
                @endforeach
                @endif
            </div>
        </div>
    </div>
</footer>