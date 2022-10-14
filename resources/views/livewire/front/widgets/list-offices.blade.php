<div class="grid grid-cols-1 gap-8 mt-8 xl:mt-16 md:grid-cols-2 xl:grid-cols-3">
    @foreach ($offices as $office)
    <livewire:front.components.office-card :office="$office"/>
    @endforeach
</div>