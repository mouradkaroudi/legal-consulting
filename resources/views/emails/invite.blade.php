<p>{{ __('Hi') }},</p>
<p>{{ __(':officeName has invited you to join them', ['officeName' => $invite->office->name]) }}.</p>
<a href="{{ route('auth.registration', ['invite_token' => $invite->token]) }}">{{ __('Click here') }}</a>!