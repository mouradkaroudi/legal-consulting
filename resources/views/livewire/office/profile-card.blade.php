<div class="w-full bg-white rounded-lg sahdow-lg overflow-hidden flex flex-col md:flex-row">
    <div class="w-full md:w-2/5 h-80">
        <a href="#">
            <img class="object-center object-cover w-full h-full" src="{{ asset( 'storage/' . $office->image) }}" alt="photo">
        </a>
    </div>
    <div class="w-full md:w-3/5 text-right p-4 md:p-4 space-y-2">
        <p class="text-xl text-gray-700 font-bold">
            <a href="#">{{ $office->name }}</a>
        </p>
        <p class="text-base text-gray-400 font-normal">Graphic Designer</p>
        <p class="text-base leading-relaxed text-gray-500 font-normal">
            {{ $office->description }}
        </p>
    </div>
</div>