<!DOCTYPE html>
<html dir="rtl" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>مشروع المحامي</title>


    {{-- ... --}}

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="">
    <x-navbar />
    <div class="relative">
        <img src="https://images.pexels.com/photos/3228766/pexels-photo-3228766.jpeg?auto=compress&amp;cs=tinysrgb&amp;dpr=2&amp;h=750&amp;w=1260" class="absolute inset-0 object-cover w-full h-full" alt="" />
        <div class="relative bg-opacity-75 bg-green-700">
            <svg class="absolute inset-x-0 bottom-0 text-white" viewBox="0 0 1160 163">
                <path fill="currentColor" d="M-164 13L-104 39.7C-44 66 76 120 196 141C316 162 436 152 556 119.7C676 88 796 34 916 13C1036 -8 1156 2 1216 7.7L1276 13V162.5H1216C1156 162.5 1036 162.5 916 162.5C796 162.5 676 162.5 556 162.5C436 162.5 316 162.5 196 162.5C76 162.5 -44 162.5 -104 162.5H-164V13Z"></path>
            </svg>
            <div class="relative px-4 py-16 mx-auto overflow-hidden sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20">
                <div class="flex flex-col items-center justify-between xl:flex-row">
                    <div class="w-full max-w-xl mb-12 xl:mb-0 xl:pr-16 xl:w-7/12">
                        <h2 class="max-w-lg mb-6 font-sans text-3xl font-bold tracking-tight text-white sm:text-4xl sm:leading-none">
                            The quick, brown fox <br class="hidden md:block" />
                            jumps over a lazy dog
                        </h2>
                        <p class="max-w-xl mb-4 text-base text-gray-200 md:text-lg">
                            Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudan, totam rem aperiam, eaque ipsa quae.
                        </p>
                        <a href="/" aria-label="" class="inline-flex items-center font-semibold tracking-wider transition-colors duration-200 text-teal-accent-400 hover:text-teal-accent-700">
                            Learn more
                            <svg class="inline-block w-3 ml-2" fill="currentColor" viewBox="0 0 12 12">
                                <path d="M9.707,5.293l-5-5A1,1,0,0,0,3.293,1.707L7.586,6,3.293,10.293a1,1,0,1,0,1.414,1.414l5-5A1,1,0,0,0,9.707,5.293Z"></path>
                            </svg>
                        </a>
                    </div>
                    <div class="w-full max-w-xl xl:px-8 xl:w-5/12">
                        <div class="bg-white rounded shadow-2xl p-7 sm:p-10">
                            <h3 class="mb-4 text-xl font-semibold sm:text-center sm:mb-6 sm:text-2xl">
                                Sign up for updates
                            </h3>
                            <form>
                                <div class="mb-1 sm:mb-2">
                                    <label for="firstName" class="inline-block mb-1 font-medium">First name</label>
                                    <input placeholder="John" required="" type="text" class="flex-grow w-full h-12 px-4 mb-2 transition duration-200 bg-white border border-gray-300 rounded shadow-sm appearance-none focus:border-deep-green-accent-400 focus:outline-none focus:shadow-outline" id="firstName" name="firstName" />
                                </div>
                                <div class="mb-1 sm:mb-2">
                                    <label for="lastName" class="inline-block mb-1 font-medium">Last name</label>
                                    <input placeholder="Doe" required="" type="text" class="flex-grow w-full h-12 px-4 mb-2 transition duration-200 bg-white border border-gray-300 rounded shadow-sm appearance-none focus:border-deep-green-accent-400 focus:outline-none focus:shadow-outline" id="lastName" name="lastName" />
                                </div>
                                <div class="mb-1 sm:mb-2">
                                    <label for="email" class="inline-block mb-1 font-medium">E-mail</label>
                                    <input placeholder="john.doe@example.org" required="" type="text" class="flex-grow w-full h-12 px-4 mb-2 transition duration-200 bg-white border border-gray-300 rounded shadow-sm appearance-none focus:border-deep-green-accent-400 focus:outline-none focus:shadow-outline" id="email" name="email" />
                                </div>
                                <div class="mt-4 mb-2 sm:mb-4">
                                    <button type="submit" class="inline-flex items-center justify-center w-full h-12 px-6 font-medium tracking-wide text-white transition duration-200 rounded shadow-md bg-green-400 hover:bg-green-700 focus:shadow-outline focus:outline-none">
                                        Subscribe
                                    </button>
                                </div>
                                <p class="text-xs text-gray-600 sm:text-sm">
                                    We respect your privacy. Unsubscribe at any time.
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="w-full">
        <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-4 py-12">
            <div class="text-center pb-12">
                <h2 class="text-base font-bold text-indigo-600">
                    لدينا افضل مقدمي الخدمات
                </h2>
                <h1 class="font-bold text-3xl md:text-4xl lg:text-5xl">
                    مزودي الخدمة الرائعين لدينا
                </h1>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="w-full bg-gray-900 rounded-lg sahdow-lg p-12 flex flex-col justify-center items-center">
                    <div class="mb-8">
                        <img class="object-center object-cover rounded-full h-36 w-36" src="https://images.unsplash.com/flagged/photo-1570612861542-284f4c12e75f?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1170&q=80" alt="photo">
                    </div>
                    <div class="text-center">
                        <p class="text-xl text-white font-bold mb-2">Dany Bailey</p>
                        <p class="text-base text-gray-400 font-normal">Software Engineer</p>
                    </div>
                </div>
                <div class="w-full bg-gray-900 rounded-lg sahdow-lg p-12 flex flex-col justify-center items-center">
                    <div class="mb-8">
                        <img class="object-center object-cover rounded-full h-36 w-36" src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1170&q=80" alt="photo">
                    </div>
                    <div class="text-center">
                        <p class="text-xl text-white font-bold mb-2">Lucy Carter</p>
                        <p class="text-base text-gray-400 font-normal">Graphic Designer</p>
                    </div>
                </div>
                <div class="w-full bg-gray-900 rounded-lg sahdow-lg p-12 flex flex-col justify-center items-center">
                    <div class="mb-8">
                        <img class="object-center object-cover rounded-full h-36 w-36" src="https://images.unsplash.com/photo-1499952127939-9bbf5af6c51c?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1176&q=80" alt="photo">
                    </div>
                    <div class="text-center">
                        <p class="text-xl text-white font-bold mb-2">Jade Bradley</p>
                        <p class="text-base text-gray-400 font-normal">Dev Ops</p>
                    </div>
                </div>
                <div class="w-full bg-gray-900 rounded-lg sahdow-lg p-12 flex flex-col justify-center items-center">
                    <div class="mb-8">
                        <img class="object-center object-cover rounded-full h-36 w-36" src="https://images.unsplash.com/flagged/photo-1570612861542-284f4c12e75f?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1170&q=80" alt="photo">
                    </div>
                    <div class="text-center">
                        <p class="text-xl text-white font-bold mb-2">Dany Bailey</p>
                        <p class="text-base text-gray-400 font-normal">Software Engineer</p>
                    </div>
                </div>
                <div class="w-full bg-gray-900 rounded-lg sahdow-lg p-12 flex flex-col justify-center items-center">
                    <div class="mb-8">
                        <img class="object-center object-cover rounded-full h-36 w-36" src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1170&q=80" alt="photo">
                    </div>
                    <div class="text-center">
                        <p class="text-xl text-white font-bold mb-2">Lucy Carter</p>
                        <p class="text-base text-gray-400 font-normal">Graphic Designer</p>
                    </div>
                </div>
                <div class="w-full bg-gray-900 rounded-lg sahdow-lg p-12 flex flex-col justify-center items-center">
                    <div class="mb-8">
                        <img class="object-center object-cover rounded-full h-36 w-36" src="https://images.unsplash.com/photo-1499952127939-9bbf5af6c51c?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1176&q=80" alt="photo">
                    </div>
                    <div class="text-center">
                        <p class="text-xl text-white font-bold mb-2">Jade Bradley</p>
                        <p class="text-base text-gray-400 font-normal">Dev Ops</p>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="bg-gray-50">
        <div class="mx-auto max-w-7xl py-12 px-4 sm:px-6 lg:flex lg:items-center lg:justify-between lg:py-16 lg:px-8">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
                <span class="block">هل أنت جاهز للإنظمام لنا ؟</span>
                <span class="block text-indigo-600">إبدأ بفتح حسابك على موقع المحامي الآن</span>
            </h2>
            <div class="mt-8 flex lg:mt-0 lg:flex-shrink-0">
                <div class="inline-flex rounded-md shadow">
                    <a href="#" class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-5 py-3 text-base font-medium text-white hover:bg-indigo-700">Get started</a>
                </div>
                <div class="ml-3 inline-flex rounded-md shadow">
                    <a href="#" class="inline-flex items-center justify-center rounded-md border border-transparent bg-white px-5 py-3 text-base font-medium text-indigo-600 hover:bg-indigo-50">Learn more</a>
                </div>
            </div>
        </div>
    </div>

    <div class="px-4 py-16 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20">
        <div class="grid gap-8 row-gap-5 lg:grid-cols-3">
            <div class="relative p-px overflow-hidden transition duration-300 transform border rounded shadow-sm hover:scale-105 group hover:shadow-xl">
                <div class="absolute bottom-0 left-0 w-full h-1 duration-300 origin-left transform scale-x-0 bg-deep-purple-accent-400 group-hover:scale-x-100"></div>
                <div class="absolute bottom-0 left-0 w-1 h-full duration-300 origin-bottom transform scale-y-0 bg-deep-purple-accent-400 group-hover:scale-y-100"></div>
                <div class="absolute top-0 left-0 w-full h-1 duration-300 origin-right transform scale-x-0 bg-deep-purple-accent-400 group-hover:scale-x-100"></div>
                <div class="absolute bottom-0 right-0 w-1 h-full duration-300 origin-top transform scale-y-0 bg-deep-purple-accent-400 group-hover:scale-y-100"></div>
                <div class="relative p-5 bg-white rounded-sm">
                    <div class="flex flex-col mb-2 lg:items-center lg:flex-row">
                        <h6 class="font-semibold leading-5">This is about justice</h6>
                    </div>
                    <p class="mb-2 text-sm text-gray-900">
                        Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque rem aperiam.
                    </p>
                    <a href="/" aria-label="" class="inline-flex items-center text-sm font-semibold transition-colors duration-200 text-deep-purple-accent-400 hover:text-deep-purple-800">Learn more</a>
                </div>
            </div>
        </div>
    </div>
    @include('footer')
</body>

</html>