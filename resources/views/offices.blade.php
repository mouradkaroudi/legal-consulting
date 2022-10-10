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

    <div class="mx-auto max-w-screen-xl px-4 md:px-6 my-12">

        <div class="flex flex-col">
            <h2 class="text-xl font-bold mb-4 text-stone-600">
                بحث عن مقدم خدمة
            </h2>

            <div class="bg-white p-6 rounded-xl shadow-lg">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    <div class="flex flex-col">
                        <label for="name" class="font-medium text-sm text-stone-600">Name</label>
                        <input type="text" id="name" placeholder="john doe" class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-300 focus:ring focus:ring-orange-200 focus:ring-opacity-50">
                    </div>

                    <div class="flex flex-col">
                        <label for="email" class="font-medium text-sm text-stone-600">Email</label>
                        <input type="email" id="email" placeholder="johndoe@example.com" class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-300 focus:ring focus:ring-orange-200 focus:ring-opacity-50">
                    </div>

                    <div class="flex flex-col">
                        <label for="status" class="font-medium text-sm text-stone-600">Status</label>

                        <select id="status" class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-300 focus:ring focus:ring-orange-200 focus:ring-opacity-50">
                            <option>Active</option>
                            <option>Pending</option>
                            <option>Deleted</option>
                        </select>
                    </div>
                </div>

            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-12">
            @foreach ($offices as $office)
            <x-legal-office-card />
            @endforeach
        </div>
    </div>
</body>

</html>