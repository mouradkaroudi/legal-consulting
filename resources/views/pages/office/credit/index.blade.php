@extends('layouts.dashboard', ['pageTitle' => 'الرصيد'])

@section('actions')

@endsection

@section('content')
<livewire:office.balance.overview :office="$office" />
<div class="space-y-8 my-8 border-t"></div>
<div class="grid md:grid-cols-2 gap-6">
    <div class="bg-white border rounded-lg shadow">
        <div class="p-6 border-b">
            <h4 class="leading-4 text-xl font-bold">{{ __('Balance withdrawal request') }}</h4>
        </div>
        <div class="p-6">
            @if( $office->withdrawal_methods )
            <livewire:office.balance.withdrawals :office="$office"/>
            @else
            {{ __('Please add at least one withdrawal method to your account to be able to withdraw your funds') }}.
            <x-filament::link href="{{ route('office.settings', ['tab' => 'withdrawal']) }}">
                {{ __('Click here') }}
            </x-filament::link>
            @endif
        </div>
    </div>
</div>
<div class="space-y-8 my-8 border-t"></div>
<livewire:office.transactions.table />
@endsection