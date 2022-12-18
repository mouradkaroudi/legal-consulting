@props(['office', 'class' => ''])

<form method="POST" action="{{ route('account.current-office.update') }}" x-data>
    @method('PUT')
    @csrf
    <input type="hidden" name="office_id" value="{{ $office->id }}">
    <a href="#" class="{{ $class ? $class : 'block px-4 py-2 text-gray-700 hover:bg-gray-100' }}" role="menuitem" tabindex="-1" x-on:click.prevent="$root.submit();">
        {{ $slot }}
    </a>
</form>