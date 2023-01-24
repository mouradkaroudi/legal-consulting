<div class="bg-white p-3">
    <div class="flex items-center space-x-3 space-x-reverse font-semibold text-gray-900 text-xl leading-8 mb-4">
        <span class="text-green-500">
            <svg class="h-5 fill-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
        </span>
        <span>موظفي المكتب</span>
    </div>
    <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 md:grid-cols-4">
        @foreach( $office->employees as $employee )
        <div class="text-center border p-4 rounded-lg">
            <img class="w-12 h-12 rounded-full mx-auto mb-2" src="{{ $employee->user->avatar_url() }}" alt="">
            <span class="block font-bold">{{ $employee->user->name }}</span>
            @if($employee->job_title)
                <div class="my-2"></div>
                <span class="bg-gray-100 rounded-full px-4 py-1 font-bold text-sm mt-4">{{ $employee->job_title }}</span>
            @endif
        </div>
        @endforeach
    </div>
</div>