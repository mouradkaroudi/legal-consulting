<section class="bg-white">
    <div class="container max-w-4xl px-6 py-10 mx-auto">
        <h1 class="text-4xl font-semibold text-center text-gray-800">الأسئلة الشائعة</h1>

        <div class="mt-12 space-y-4">
            @if(!empty($posts))
            @foreach($posts as $post)
            <div x-data="{open:false}" class="border-2 border-gray-100 rounded-lg">
                <button @click="open=!open" class="flex items-center justify-between w-full p-8">
                    <h1 class="font-semibold text-gray-700">{{ $post->title }}</h1>

                    <span class="text-gray-400 bg-gray-200 rounded-full">
                        <x-heroicon-o-chevron-down class="w-6 h-6" x-show="!open"/>
                        <x-heroicon-o-chevron-up class="w-6 h-6" x-cloak x-show="open"/>
                    </span>
                </button>

                <hr class="border-gray-200">

                <div x-show="open" x-cloak class="p-8">
                    {!! $post->content !!}
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
</section>