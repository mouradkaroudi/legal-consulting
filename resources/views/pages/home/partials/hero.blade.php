@if($slides)
<div id="homepage-hero" class="relative bg-no-repeat bg-cover" style="background-image: url({{ $slides[0]['image'] }});">
    <div id="homepage-hero-overlay" class="opacity-60 absolute top-0 left-0 w-full h-full" style="background-color: {{  $slides[0]['bg_color']; }}"></div>
    <div class="relative px-4 py-16 mx-auto overflow-hidden max-w-screen-xl md:px-6 lg:py-20">
        <div class="flex flex-col items-center justify-between xl:flex-row">
            <div id="slide-container" class="w-full max-w-xl mb-12 xl:w-8/12" style="color: {{  $slides[0]['text_color']; }}">
                @foreach( $slides as $index=>$slider )
                <div data-index="{{ $index }}" class="hero-slide-item animate-fade {{ $index == 0 ? 'active' : '' }}">
                    <h2 class="max-w-lg mb-6 font-sans text-5xl leading-tight font-bold">
                        {{ $slider['title'] }}
                    </h2>
                    <p class="max-w-xl mb-4 text-lg">
                        {{ $slider['content'] }}
                    </p>
                </div>
                @endforeach
                <div class="flex gap-2 mt-4">
                    @foreach( $slides as $index=>$slider )
                    <button data-index="{{ $index }}" class="hero-slide-pagination {{ $index == 0 ? 'active' : '' }} w-4 h-4"></button>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
</div>
<script>
    var slides = JSON.parse("{!! json_encode($slides) !!}");
    var currentSlide = 1;

    function displaySlide(index) {
        document.querySelector(`.hero-slide-item.active`).classList.remove('active');
        document.querySelector(`.hero-slide-pagination.active`).classList.remove('active');

        document.querySelector(`.hero-slide-item[data-index="${index}"]`).classList.add('active')
        document.querySelector(`.hero-slide-pagination[data-index="${index}"]`).classList.add('active')
        document.getElementById('homepage-hero').style.backgroundImage = `url(${slides[index]['image']})`
        document.getElementById('homepage-hero-overlay').style.backgroundColor = `${slides[index]['bg_color']}`
        document.getElementById('slide-container').style.color = `${slides[index]['text_color']}`

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
