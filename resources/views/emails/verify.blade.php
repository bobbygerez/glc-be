@component('mail::message')
# Hi, Welcome {{ $array['name'] }}!

To verify your email address ({{ $array['email'] }}), please click the following link.

<br />
{{ $array['activation_code']}}

Thanks,<br>
A2ROnline Staff
@endcomponent
