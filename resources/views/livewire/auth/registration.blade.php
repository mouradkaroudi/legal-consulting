<form wire:submit.prevent="submit" class="space-y-8">
    {{ $this->form }}
    <button 
        type="submit"
        wire:loading.attr="disabled"
        class="w-full text-white disabled:cursor-not-allowed disabled:bg-primary-400 bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
        إنشاء حساب
    </button>
    <p class="text-sm font-light text-gray-500 dark:text-gray-400">
        لديك حساب? <a href="#" class="font-medium text-primary-600 hover:underline dark:text-primary-500">سجل الدخول</a>
    </p>
    <!--  -->
</form>