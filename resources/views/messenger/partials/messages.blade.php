<div class="flex flex-row py-4">
    <img class="object-cover w-12 h-12 border-2 border-gray-300 rounded-full" alt="{{ $message->user->name }}" src="//www.gravatar.com/avatar/{{ md5($message->user->email) }} ?s=64">
    <div class="flex-col mt-1">
        <div class="flex items-center flex-1 px-4 font-bold leading-tight">{{ $message->user->name }}
            <span class="mr-2 text-xs font-normal text-gray-500"> {{ $message->created_at->diffForHumans() }}</span>
        </div>
        <div class="flex-1 px-2 ml-2 leading-loose text-gray-600">
            @if($message->type == 'attachment')
            <a href="{{ asset('storage/' . $message->body) }}" target="_blank" class="block p-4 rounded-lg border border-blue-200 bg-blue-50 mt-2 shadow ">
                {{ __('Open the attachment') }}
            </a>
            @else
            {{ $message->body }}
            @endif
        </div>
    </div>
</div>