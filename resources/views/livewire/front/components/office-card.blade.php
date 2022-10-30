<a href="{{ route('searchoffice', ['digitalOffice' => $office->id]) }}" class="flex flex-col items-center p-4 border sm:p-6 rounded-xl">
    @if($office->image)
    <img class="object-cover w-full rounded-xl aspect-square" src="{{ asset('storage/' . $office->image) }}" alt="">
    @else
    <div class="bg-gray-300 w-full text-center rounded-lg h-[180px]">
        <svg class="mx-auto top-2/4 translate-y-2/4" xmlns="http://www.w3.org/2000/svg" width="96" height="96" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512">
        <g>
            <g>
                <path d="M465.972,372.171H315.624c-25.38,0-46.028,20.648-46.028,46.028c0,5.722,4.655,10.378,10.378,10.378h221.65
                    c5.722,0,10.378-4.655,10.378-10.378C512,392.819,491.352,372.171,465.972,372.171z M292.034,408.178
                    c3.909-9.167,13.011-15.609,23.59-15.609h150.348c10.579,0,19.68,6.441,23.589,15.609H292.034z"/>
            </g>
        </g>
        <g>
            <g>
                <path d="M461.544,297.414v-158.29c12.129-3.199,21.1-14.262,21.1-27.382c0-15.615-12.703-28.318-28.318-28.318H327.269
                    c-15.614,0-28.317,12.703-28.317,28.318c0,13.12,8.971,24.182,21.1,27.382v52.551h-98.913c-0.515-5.151-4.861-9.173-10.147-9.173
                    H35.772C16.046,182.503,0,198.549,0,218.274s16.046,35.771,35.772,35.771h175.219c5.286,0,9.633-4.023,10.147-9.173h98.913v52.543
                    c-12.129,3.174-21.1,14.146-21.1,27.16c0,15.614,12.703,28.317,28.317,28.317h127.058c15.615,0,28.318-12.703,28.318-28.317
                    C482.644,311.561,473.672,300.588,461.544,297.414z M200.792,233.647H35.772c-8.477-0.001-15.373-6.898-15.373-15.373
                    c0-8.477,6.897-15.372,15.373-15.372h165.02V233.647z M319.35,111.742c0-4.367,3.552-7.92,7.919-7.92h127.058
                    c4.366,0,7.92,3.552,7.92,7.92s-3.552,7.92-7.92,7.92H327.269C322.903,119.662,319.35,116.109,319.35,111.742z M441.145,140.06
                    v156.426H340.449V140.06H441.145z M221.19,224.473v-12.398h98.861v12.398H221.19z M454.327,332.494H327.269
                    c-4.366,0-7.919-3.551-7.919-7.919c0-4.313,3.479-7.69,7.919-7.69h127.058c4.441,0,7.92,3.378,7.92,7.69
                    C462.246,328.941,458.694,332.494,454.327,332.494z"/>
            </g>
        </g>
        <g>
            <g>
                <path d="M421.227,206.024c-5.633,0-10.199,4.567-10.199,10.199v60.175c0,5.632,4.566,10.199,10.199,10.199c5.633,0,10.199-4.567,10.199-10.199v-60.175C431.426,210.592,426.86,206.024,421.227,206.024z"/>
            </g>
        </g>
        <g>
            <g>
                <path d="M421.227,174.407c-5.633,0-10.199,4.567-10.199,10.199v3.06c0,5.632,4.566,10.199,10.199,10.199c5.633,0,10.199-4.567,10.199-10.199v-3.06C431.426,178.974,426.86,174.407,421.227,174.407z"/>
            </g>
        </g>
        </svg>
    </div>
    @endif
    <h1 class="mt-4 text-xl font-bold text-gray-700 capitalize">{{ $office->name }}</h1>

    <p class="mt-2 text-gray-500 capitalize dark:text-gray-300">Full stack developer</p>

</a>