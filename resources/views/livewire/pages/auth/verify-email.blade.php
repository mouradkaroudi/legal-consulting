<div class="max-w-screen-md bg-white px-4 py-4 border rounded-lg md:px-6 mx-auto my-12">
    <div class="text-gray-600 mb-6">
        {{ __('Thank you for your registration! Before we get started, could you please verify your email address by clicking on the link we just emailed you? If you do not receive the email, we will gladly email you.') }}
    </div>

    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <div>
            <x-filament::button type="submit">
                {{ __('Resend Verification Email') }}
            </x-filament::button>
        </div>
    </form>

    @if (session('status') == 'verification-link-sent')
    <div class="mb-4 font-medium text-sm text-green-600 mt-4">
        {{ __('A new verification link has been sent to the email address you provided during registration.') }}
    </div>
    @endif

</div>