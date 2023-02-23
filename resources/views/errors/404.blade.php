@extends('layouts.front.index', ['title' => __('404 page not found')])
@section('content')
<section class="flex items-center h-full p-16">
    <div class="container flex flex-col items-center justify-center px-5 mx-auto my-8">
        <div class="max-w-md text-center">
            <h2 class="mb-8 font-bold text-9xl">
                <span class="sr-only">{{ __('Error') }}</span>404
            </h2>
            <p class="text-2xl font-semibold md:text-3xl">{{ __("Sorry, we couldn't find this page") }}.</p>
            <p class="mt-4 mb-8">{{ __('But dont worry, you can find plenty of other things on our homepage') }}.</p>
            <a rel="noopener noreferrer" href="{{ route('home') }}" class="px-8 py-3 font-semibold rounded">
                {{ __('Back to homepage') }}
            </a>
        </div>
    </div>
</section>
@endsection