@extends('layouts.account', ['title' => __('Balance')])
@section('content')
<livewire:account.balance-overview />

<div class="space-y-8 my-8 border-t"></div>
<div class="grid md:grid-cols-2 gap-6">
    <div class="bg-white border rounded-lg shadow">
        <div class="p-6 border-b">
            <h4 class="leading-4 text-xl font-bold">{{ __('Balance withdrawal request') }}</h4>
        </div>
        <div class="p-6">
            @if( auth()->user()->withdrawal_methods )
            <livewire:account.credit.withdraw />
            @else
            {{ __('Please add at least one withdrawal method to your account to be able to withdraw your funds') }}.
            <x-filament::link href="{{ route('account.settings') }}">
                {{ __('Click here') }}
            </x-filament::link>
            @endif
            
        </div>
    </div>
</div>

<div class="space-y-8 my-8 border-t"></div>

<livewire:account.transactions-table />

@endsection