<div class="border p-4 bg-white shadow-sm rounded-lg lg:flex lg:items-center lg:justify-between">
    <div class="min-w-0 flex-1">
        <h2 class="text-xl font-bold leading-7 text-gray-900 sm:truncate sm:tracking-tight">
            {{ $thread->subject }}
        </h2>
        <div class="mt-1 flex flex-col sm:mt-0 sm:flex-row sm:flex-wrap sm:space-x-6 sm:space-x-reverse">
            <div class="mt-2 flex items-center text-sm text-gray-500">
                @if( $viewer === 'user' )
                    <x-heroicon-s-office-building class="ml-1.5 h-5 w-5 flex-shrink-0 text-gray-400"/>
                    name
                @else
                    <x-heroicon-s-user class="ml-1.5 h-5 w-5 flex-shrink-0 text-gray-400"/>
                    name
                @endif
            </div>
            @if($thread->closed_at)
            <div class="mt-2 flex items-center text-sm text-gray-500">
                <!-- Heroicon name: mini/calendar -->
                <svg class="ml-1.5 h-5 w-5 flex-shrink-0 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M5.75 2a.75.75 0 01.75.75V4h7V2.75a.75.75 0 011.5 0V4h.25A2.75 2.75 0 0118 6.75v8.5A2.75 2.75 0 0115.25 18H4.75A2.75 2.75 0 012 15.25v-8.5A2.75 2.75 0 014.75 4H5V2.75A.75.75 0 015.75 2zm-1 5.5c-.69 0-1.25.56-1.25 1.25v6.5c0 .69.56 1.25 1.25 1.25h10.5c.69 0 1.25-.56 1.25-1.25v-6.5c0-.69-.56-1.25-1.25-1.25H4.75z" clip-rule="evenodd" />
                </svg>
                {{ $thread->closed_at }}
            </div>
            @endif
        </div>
    </div>
    @if(!$thread->closed_at)
        <div class="mt-5 flex gap-4 lg:mt-0 lg:ml-4">            
            @if($showCreateOffer)
            <livewire:office.create-order :officeId="$thread->receiver->id" :beneficiaryId="$thread->user_id"/>
            @endif
            @if($showCloseConversation)
            <span class="block">
                <livewire:messages.close-thread :threadId="$thread->id"/>
            </span>
            @endif
        </div>
    @endif
</div>