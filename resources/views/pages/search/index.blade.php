@extends('layouts.front.index')
@section('content')
<div class="mx-auto max-w-screen-xl px-4 md:px-6 my-12">

    <div class="flex flex-col">
        <h2 class="text-xl font-bold mb-4 text-stone-600">
            بحث عن مقدم خدمة
        </h2>

        <div class="bg-white p-6 rounded-xl shadow-lg">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                <div class="flex flex-col">
                    <label for="name" class="font-medium text-sm text-stone-600">الإسم</label>
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

    <livewire:front.widgets.list-offices />

</div>
@endsection