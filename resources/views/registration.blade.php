<!DOCTYPE html>
<html dir="rtl" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>مشروع المحامي - تسجيل حساب</title>

    {{-- ... --}}

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="">
    <x-navbar />

    <div class="max-w-screen-xl px-4 md:px-6 mx-auto my-12">
        <div class="mb-8">
            <h1 class="text-4xl font-bold mb-4">مرحبا بك في مشروع المحامي</h1>
            <p class="text-xl">سجل حساب جديد و استفد(ي) من خدمات الموقع المتعددة</p>
        </div>

        <div class="grid grid-cols-2 gap-6">
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <form class="space-y-4 md:space-y-6" action="{{ route('registration') }}" method="POST">
                    @csrf
                    <div class="border-b border-gray-300 mb-6 pb-2">
                        <h3 class="mb-5 text-lg font-medium text-gray-900 dark:text-white">هل تريد الإنضمام لنا ك</h3>
                        <ul class="grid gap-6 w-full md:grid-cols-2">
                            <li>
                                <input type="radio" id="account-type-provider" name="account_type" value="provider" class="hidden peer" required>
                                <label for="account-type-provider" class="inline-flex justify-between items-center p-5 w-full text-gray-500 bg-white rounded-lg border border-gray-200 cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                    <div class="block">
                                        <div class="w-full text-lg font-semibold">مقدم خدمة</div>
                                        <div class="w-full">تقديم خدمات و اشتشارات </div>
                                    </div>
                                    <svg aria-hidden="true" class="mr-3 w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                </label>
                            </li>
                            <li>
                                <input type="radio" id="account-type-beneficiary" name="account_type" value="beneficiary" class="hidden peer">
                                <label for="account-type-beneficiary" class="inline-flex justify-between items-center p-5 w-full text-gray-500 bg-white rounded-lg border border-gray-200 cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                    <div class="block">
                                        <div class="w-full text-lg font-semibold">مستفيد</div>
                                        <div class="w-full">الإستفادة من خدمات و استشارات</div>
                                    </div>
                                    <svg aria-hidden="true" class="mr-3 w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                </label>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">الإسم الكامل</label>
                        <input type="name" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="الإسم الكامل">
                    </div>
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">البريد الإلكتروني</label>
                        <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@company.com">
                    </div>
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">كلمة السر</label>
                        <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                    </div>
                    <div>
                        <label for="confirm-password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">تأكيد كلمة السر</label>
                        <input type="confirm-password" name="confirm_password" id="confirm-password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                    </div>
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input id="terms" aria-describedby="terms" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800" required="">
                        </div>
                        <div class="mr-3 text-sm">
                            <label for="terms" class="font-light text-gray-500 dark:text-gray-300">أوافق على <a class="font-medium text-primary-600 hover:underline dark:text-primary-500" href="#">شروط الإستخدام</a></label>
                        </div>
                    </div>
                    <button type="submit" class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">إنشاء حساب</button>
                    <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                        لديك حساب? <a href="#" class="font-medium text-primary-600 hover:underline dark:text-primary-500">سجل الدخول</a>
                    </p>
                </form>

            </div>
        </div>
    </div>

    @include('footer')

</body>

</html>