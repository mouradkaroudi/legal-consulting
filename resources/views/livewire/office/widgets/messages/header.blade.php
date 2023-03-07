<div class="border p-4 bg-white shadow-sm rounded-lg lg:flex lg:items-center lg:justify-between">
    <div class="min-w-0 flex-1">
        <h2 class="text-xl font-bold leading-7 text-gray-900 sm:truncate sm:tracking-tight">
            {{ $thread->subject }}
        </h2>
        <div class="mt-1 flex flex-col sm:mt-0 sm:flex-row sm:flex-wrap sm:space-x-6 sm:space-x-reverse">
            <div class="mt-2 flex items-center text-sm text-gray-500">
                <x-heroicon-s-user class="ml-1.5 h-5 w-5 flex-shrink-0 text-gray-400" />
                {{ $thread->sender->name }}
            </div>
            @if($thread->closed_at)
            <div class="mt-2 flex items-center text-sm text-gray-500">
                <x-heroicon-o-calendar class="ml-1.5 h-5 w-5 flex-shrink-0 text-gray-400" />
                {{ $thread->closed_at }}
            </div>
            @endif
        </div>
    </div>
    @if(!$thread->closed_at)
    <div class="mt-5 flex gap-4 lg:mt-0 lg:ml-4">
        @if($showCreateOffer)
        <livewire:office.create-order :officeId="$thread->receiver->id" :beneficiaryId="$thread->sender->id" />
        @endif
        @if($showCloseConversation)
        <span class="block">
            <livewire:messages.close-thread :threadId="$thread->id" />
        </span>
        @endif
    </div>
    @endif
</div>