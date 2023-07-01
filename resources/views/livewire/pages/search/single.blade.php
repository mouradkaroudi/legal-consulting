@php
$experiences = [];
$educations = [];
$gender = null;
$specializations = $office->specializations ? $office->specializations : [];
$professionName = $office->profession ? $office->profession->name : null;

if(!empty($office->owner->profile)) {
$experiences = $office->owner->profile->experiences ?? [];
$educations = $office->owner->profile->education ?? [];
$gender = $office->owner->profile->gender;
}
@endphp
<div class="mx-auto max-w-screen-xl px-4 lg:px-6 my-12 min-h-[580px]">
    <div class="lg:flex no-wrap lg:gap-6">
        <!-- Left Side -->
        <div class="w-full lg:w-3/12">
            @include('pages.search.single.partials.profile-card')
        </div>
        <!-- Right Side -->
        <div class="w-full lg:w-9/12">
            @include('pages.search.single.partials.about')
            <div class="my-4"></div>
            @include('pages.search.single.partials.experience-education')
            <div class="my-4"></div>
            @include('pages.search.single.partials.employees')
            <div class="my-4"></div>
            @include('pages.search.single.partials.reviews')
        </div>
    </div>
</div>