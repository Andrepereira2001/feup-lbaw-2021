@component('mail::message')
# Contact Us

{{$name}} with the email {{$email}} sent this:

{{$message}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
