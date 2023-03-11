<div class="flex flex-row py-4">
    <img class="object-cover w-12 h-12 border-2 border-gray-300 rounded-full" alt="{{ $message->model->name }}" src="//www.gravatar.com/avatar/{{ md5($message->model->email) }} ?s=64">
    <div class="flex-col mt-1">
        <div class="flex items-center gap-2 flex-1 px-4 font-bold leading-tight">
            {{ $message->model->name }} 
            @if($message->model?->contact_hidden_offices)
            <span class="bg-blue-700 rounded-full px-4 py-1 text-xs text-white">
                {{ __('Administration') }}
            </span>
            @endif
            <span class="text-xs font-normal text-gray-500"> {{ $message->created_at->diffForHumans() }}</span>
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