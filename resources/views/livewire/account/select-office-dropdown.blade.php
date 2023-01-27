<div class="relative" x-data="{ isOpen: false }">
    <div>
        <button id="user-office-select-button" @click="isOpen = !isOpen" type="button" class="inline-flex items-center focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 ml-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800" aria-expanded="false" aria-haspopup="true"> 
        {{ __('Select an office') }}
        <svg class="mr-2 w-4 h-4" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg></button>
        </button>
    </div>
    <div 
        @click.away="isOpen = false" 
        x-show.transition.opacity="isOpen" 
        class="divide-y divide-gray-200 absolute left-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" 
        role="menu" 
        aria-orientation="vertical" 
        aria-labelledby="user-office-select-buttonn" 
        tabindex="-1"
        style="display: none;"
    >
        @if(!empty($ownedOffices))    
            <div>
                @foreach($ownedOffices as $ownedOffice)
                <x-switch-able-office :office="$ownedOffice">
                    {{ $ownedOffice->name }}
                </x-switch-able-office>
                @endforeach
            </div>
        @endif
        @if(!empty($offices))
            <div>
                @foreach($offices as $office)
                <x-switch-able-office :office="$office">
                    {{ $office->name }}
                </x-switch-able-office>
                @endforeach
            </div>
        @endif
    </div>
</div>