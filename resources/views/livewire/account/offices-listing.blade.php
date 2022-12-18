<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    @forelse($offices as $office)
    <div class="flex items-center flex-col border rounded-2xl p-6">
        <x-heroicon-o-office-building class="w-10 h-10 text-green-700 border-green-700 border-2 rounded-full mb-6 p-1 "/>
        <h4 class="w-full block text-xl font-bold text-center pb-6 border-b mb-6">{{ $office->name }}</h4>
            <x-switch-able-office :office="$office" :class="'border border-green-700 rounded-full hover:bg-green-700 
                text-green-700
                hover:text-white
                font-bold flex items-center w-full
                px-4 py-2
                transition justify-center'">
                دخول للمكتب
            </x-switch-able-office>
    </div>
    @empty
        empty
    @endforelse
</div>
