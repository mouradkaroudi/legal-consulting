<div class="bg-white p-3">
    <div class="flex items-center space-x-3 rtl:space-x-reverse font-semibold text-gray-900 text-xl leading-8 mb-4">
        <span class="text-green-500">
            <svg class="h-5 fill-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
        </span>
        <span>{{ __('Reviews') }}</span>
    </div>
    <div class="grid grid-cols-1">
        @if(!empty($orders))
        @foreach( $orders as $order )
        @foreach($order->reviews as $review)
        <article>
            <div class="flex items-center mb-4 -space-x-4">
                <img class="w-10 h-10 rounded-full ml-2" src="{{ $review->author->avatar_url() }}" alt="">
                <div class="space-y-1 font-medium dark:text-white">
                    <p>
                        {{ $review->author->name }}
                        <time datetime="{{ $review->author->created_at }}" class="block text-sm text-gray-500 dark:text-gray-400">{{ __('Member since :date', ['date' => $order->latestReview()->author->created_at->translatedFormat(config('tables.date_format'))]) }}</time>
                    </p>
                </div>
            </div>
            <div class="flex items-center mb-1">
                @for ($i = 0; $i < $review->rating; $i++)
                    <svg aria-hidden="true" class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <title>{{ $i }} star</title>
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                    </svg>
                    @endfor
                    @if(!empty($review->title))
                    <h3 class="ml-2 text-sm font-semibold text-gray-900 dark:text-white">{{ $review->title }}</h3>
                    @endif
            </div>
            <footer class="mb-5 text-sm text-gray-500 dark:text-gray-400">
                <p><time datetime="{{ $review->created_at }}">{{ $review->created_at->translatedFormat(config('tables.date_format')) }}</time></p>
            </footer>

            <p class="mb-2 font-light text-gray-500 dark:text-gray-400">
                {{ $review->review }}
            </p>
        </article>
        @endforeach
        @endforeach
        @else
        <p>{{ __('There are no reviews currently.') }}</p>
        @endif

    </div>
</div>