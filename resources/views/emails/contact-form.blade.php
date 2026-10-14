<p>{{ __('site.email.intro') }}</p>

<p>
    <strong>{{ __('site.email.name') }}:</strong> {{ $messageData['name'] }}<br>
    <strong>{{ __('site.email.email') }}:</strong> {{ $messageData['email'] }}
</p>

<p><strong>{{ __('site.email.message') }}:</strong></p>

<p>{!! nl2br(e($messageData['message'])) !!}</p>
