@php
$slidersArray = json_decode($sliders, true);
@endphp

@if($slidersArray)
<div id="homepage-hero" class="relative" style="background-color: {{ $slidersArray[0]['color'] }};">
    <div class="relative px-4 py-16 mx-auto overflow-hidden sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20">
        <div class="flex flex-col items-center justify-between xl:flex-row">
            <div class="w-full max-w-xl mb-12 xl:mb-0 xl:pr-16 xl:w-7/12">
                @foreach( $slidersArray as $index=>$slider )
                <div data-index="{{ $index }}" class="hero-slide-item animate-fade {{ $index == 0 ? 'active' : '' }}">
                    <h2 class="max-w-lg mb-6 font-sans text-3xl font-bold tracking-tight text-white sm:text-4xl sm:leading-none">
                        {{ $slider['title'] }}
                    </h2>
                    <p class="max-w-xl mb-4 text-base text-gray-200 md:text-lg">
                        {{ $slider['content'] }}
                    </p>
                </div>
                @endforeach
                <div class="flex gap-4">
                    @foreach( $slidersArray as $index=>$slider )
                    <button data-index="{{ $index }}" class="hero-slide-pagination {{ $index == 0 ? 'active' : '' }} w-4 h-4"></button>
                    @endforeach
                </div>

            </div>
            <div class="w-full max-w-xl xl:px-8 xl:w-5/12">
                <div class="bg-white rounded shadow-2xl p-7 sm:p-10">
                    <h3 class="mb-4 text-xl font-semibold sm:text-center sm:mb-6 sm:text-2xl">
                        سجِل حسابك الآن
                    </h3>
                    <livewire:auth.login />
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var slides = JSON.parse('{!! json_encode(array_column($slidersArray,"color")) !!}');
    var currentSlide = 1;

    function displaySlide(index) {
        document.querySelector(`.hero-slide-item.active`).classList.remove('active');
        document.querySelector(`.hero-slide-pagination.active`).classList.remove('active');

        document.querySelector(`.hero-slide-item[data-index="${index}"]`).classList.add('active')
        document.querySelector(`.hero-slide-pagination[data-index="${index}"]`).classList.add('active')
        document.getElementById('homepage-hero').style.backgroundColor = slides[index]

    }

    document.querySelectorAll('.hero-slide-pagination').forEach(pag => {
        pag.addEventListener('click', function(e) {
            currentSlide = parseInt(e.target.dataset.index);
            displaySlide(parseInt(e.target.dataset.index))
        })
    })
    
    setInterval(function() {
        displaySlide(currentSlide)
        if(currentSlide == (document.querySelectorAll('.hero-slide-item').length - 1)) {
            currentSlide = 0;
        }else{
            currentSlide = currentSlide + 1;
        }
    }, 15000);
</script>
@endif
