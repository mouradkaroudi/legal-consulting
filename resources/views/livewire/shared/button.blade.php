<button 
        type="submit"
        wire:loading.attr="disabled"
        class="w-full font-medium rounded-lg text-sm px-5 py-2.5 text-center text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300">
        {{ $slot }}
    </button>
