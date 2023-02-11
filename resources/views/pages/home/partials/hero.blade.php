@if($slides)
<div id="homepage-hero" class="relative bg-no-repeat bg-cover" style="background-image: url({{ $slides[0]['image'] }});">
    <div class="bg-blue-500 bg-opacity-10 absolute top-0 left-0 w-full h-full"></div>
    <div class="relative z-10 px-4 py-16 mx-auto overflow-hidden sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20">
        <div class="flex flex-col items-center justify-between xl:flex-row">
            <div class="w-full max-w-xl mb-12 xl:mb-0 xl:pr-16 xl:w-7/12">
                @foreach( $slides as $index=>$slider )
                <div data-index="{{ $index }}" class="hero-slide-item animate-fade {{ $index == 0 ? 'active' : '' }}">
                    <h2 class="max-w-lg mb-6 font-sans text-5xl leading-tight font-bold text-white">
                        {{ $slider['title'] }}
                    </h2>
                    <p class="max-w-xl mb-4  text-gray-200 text-lg">
                        {!! $slider['content'] !!}
                    </p>
                </div>
                @endforeach
                <div class="flex gap-2 mt-4">
                    @foreach( $slides as $index=>$slider )
                    <button data-index="{{ $index }}" class="hero-slide-pagination {{ $index == 0 ? 'active' : '' }} w-4 h-4"></button>
                    @endforeach
                </div>

            </div>
            <div class="w-full max-w-xl xl:px-8 xl:w-5/12">
                <div class="bg-white rounded shadow-2xl p-7 sm:p-10">
                    <h3 class="mb-4 text-xl font-semibold sm:text-center sm:mb-6 sm:text-2xl">
                        {{ __('Sign to your account') }}
                    </h3>
                    <livewire:auth.login />
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var slides = JSON.parse('{!! json_encode(array_column($slides,"image")) !!}');
    var currentSlide = 1;

    function displaySlide(index) {
        document.querySelector(`.hero-slide-item.active`).classList.remove('active');
        document.querySelector(`.hero-slide-pagination.active`).classList.remove('active');

        document.querySelector(`.hero-slide-item[data-index="${index}"]`).classList.add('active')
        document.querySelector(`.hero-slide-pagination[data-index="${index}"]`).classList.add('active')
        document.getElementById('homepage-hero').style.backgroundImage = `url(${slides[index]})`

    }

    document.querySelectorAll('.hero-slide-pagination').forEach(pag => {
        pag.addEventListener('click', function(e) {
            currentSlide = parseInt(e.target.dataset.index);
            displaySlide(parseInt(e.target.dataset.index))
        })
    })
    /*
    setInterval(function() {
        displaySlide(currentSlide)
        if(currentSlide == (document.querySelectorAll('.hero-slide-item').length - 1)) {
            currentSlide = 0;
        }else{
            currentSlide = currentSlide + 1;
        }
    }, 15000);*/
</script>
@endif
