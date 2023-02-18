@if($image)
<div class="w-32">
    <img src="{{ asset('storage/' . setting('general_settings_site_logo')) }}" alt="{{ $this->appName }}">
</div>
@else
<span class="block font-bold text-2xl">{{ $this->appName }}</span>
@endif