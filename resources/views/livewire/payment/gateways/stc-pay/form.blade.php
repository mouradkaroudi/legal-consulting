<form x-show="open" x-cloak wire:submit.prevent="submit">
    <p class="mb-2 text-gray-700">
        {{ __("You'll be redirected to STCPay website to complete your purchase securely") }}.
    </p>
    <button type="submit" class="w-full text-white bg-[#be185d] hover:bg-[#be185d]/90 focus:ring-4 focus:ring-[#be185d]/50 rounded-lg px-5 py-3 font-bold text-base inline-flex justify-center items-center gap-4">
        <svg class="w-12" fill="#fff" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1000 1000" xml:space="preserve">

            <path d="M314.6,637.9c28.8,0,52.4-9,67.9-24.1c11.6-11.6,18.5-27.1,18.5-45.1c0-16.3-6-30.9-17.2-42.1
	c-11.2-11.2-27.1-19.3-47.3-23.2l-33.1-6.4c-13.7-2.6-21.5-9.4-21.5-18.9c0-12.4,12-21,31.4-21c12,0,22.3,3.9,29.2,10.7
	c4.3,4.7,7.3,10.8,8.2,17.6l47.7-10.7c-1.3-13.7-7.7-25.8-17.6-35.7c-15.5-15.5-39.5-25.3-67.9-25.3c-26.2,0-48.1,8.6-63.2,22.3
	c-12.9,12-20.2,28.4-20.2,46.4c0,15.9,5.2,29.2,15.5,39.5c10.3,10.3,25.4,18,45.1,22.8l32.7,7.7c16.3,3.9,23.6,9.9,23.6,20.6
	c0,13.3-12,21.1-31.8,21.1c-14.2,0-25.8-4.7-33.1-12.5c-5.2-5.2-8.2-12-8.6-19.8l-49,10.7c1.3,14.6,8.2,27.5,18.5,37.8
	C258.8,627.6,285,637.9,314.6,637.9 M677.2,637.9c31.8,0,56.3-11.6,73-27.9c13.3-12.9,21.5-27.9,25.8-43.4l-50.3-16.8
	c-2.1,7.7-6.4,15.9-13.3,22.3c-8.2,7.7-19.3,13.3-35.2,13.3c-14.6,0-28.4-5.6-38.3-15.5c-9.9-10.3-15.9-25.4-15.9-44.3
	c0-19.3,6-33.9,15.9-44.2c9.9-9.9,23.2-15,37.8-15c15.5,0,26.2,5.2,33.9,12.9c6.4,6.5,10.3,14.6,12.9,22.8l51.1-17.2
	c-3.9-15-12-30.1-24.1-42.5c-17.2-16.8-42.1-28.8-75.2-28.8c-30.5,0-58,11.6-77.8,31.4C578,465.2,566,493.1,566,525.8
	c0,32.7,12.5,60.6,32.6,80.8C618.4,626.3,646.3,637.9,677.2,637.9 M503.7,637.9c22.3,0,38.2-6.9,45.1-12.9v-46.4
	c-5.2,3.9-15.5,8.6-28.8,8.6c-9.5,0-16.3-2.2-21.5-6.9c-4.3-4.3-6.4-11.6-6.4-21.5V362.1h-56.7v58h113.4v55H435.3v97.5
	c0,19.8,6,35.7,16.8,46.8C464.1,631.5,481.7,637.9,503.7,637.9" />
        </svg>

        <span>{{ __('Checkout with STCPay') }}</span>
    </button>

    <p class="text-sm text-gray-700 mt-4 text-center">
        {{ __('Additional fees may apply') }}
    </p>

</form>