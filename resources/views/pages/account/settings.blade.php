@extends('layouts.account', ['title' => __('Account')])
@section('content')
<div>
    @if(!auth()->user()->isAccountSettled())
        <x-alert>
            {{ __('Please complete the required fields in your profile to be able to use your account.') }}
        </x-alert>
    @endif
    <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="md:col-span-1">
            <div class="px-4 sm:px-0">
                <h3 class="text-lg font-medium leading-6 text-gray-900">{{ __('Account settings') }}</h3>
                <p class="mt-1 text-sm text-gray-600">{{ __('It includes your contact information and your personal information.') }}</p>
            </div>
        </div>
        <div class="mt-5 md:col-span-2 md:mt-0">
            <livewire:account.account-info :user="$user"/>
        </div>
    </div>

    <div class="hidden sm:block" aria-hidden="true">
        <div class="py-5">
            <div class="border-t border-gray-200"></div>
        </div>
    </div>

    <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="md:col-span-1">
            <div class="px-4 sm:px-0">
                <h3 class="text-lg font-medium leading-6 text-gray-900">{{ __('Password') }}</h3>
                <p class="mt-1 text-sm text-gray-600">{{ __('Update the account password.') }}</p>
            </div>
        </div>
        <div class="mt-5 md:col-span-2 md:mt-0">
            <livewire:account.password />
        </div>
    </div>
    @if($hasProfile)
    <div class="hidden sm:block" aria-hidden="true">
        <div class="py-5">
            <div class="border-t border-gray-200"></div>
        </div>
    </div>

    <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="md:col-span-1">
            <div class="px-4 sm:px-0">
                <h3 class="text-lg font-medium leading-6 text-gray-900">{{ __('Profile settings') }}</h3>
                <p class="mt-1 text-sm text-gray-600">{{ __('Your experience and education') }}</p>
            </div>
        </div>
        <div class="mt-5 md:col-span-2 md:mt-0">
            <livewire:account.profile :profile="$profile"/>
        </div>
    </div>
    @endif
    <div class="hidden sm:block" aria-hidden="true">
        <div class="py-5">
            <div class="border-t border-gray-200"></div>
        </div>
    </div>

    <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="md:col-span-1">
            <div class="px-4 sm:px-0">
                <h3 class="text-lg font-medium leading-6 text-gray-900">{{ __('Withdrawal methods') }}</h3>
                <p class="mt-1 text-sm text-gray-600">{{ __('Information on ways to withdraw your profits from the site.') }}</p>
            </div>
        </div>
        <div class="mt-5 md:col-span-2 md:mt-0">
            <livewire:account.settings.withdrawal.table/>
        </div>
    </div>
</div>

@endsection