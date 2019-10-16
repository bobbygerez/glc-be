@component('mail::message')
# Hi, {{ $array['name'] }}!

To reset your password on this email ({{ $array['email'] }}), please click the following link.

<br />
{{ $array['activation_code']}}

Thanks,<br>
A2ROnline Staff
@endcomponent