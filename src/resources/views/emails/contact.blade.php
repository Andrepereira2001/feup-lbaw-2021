@component('mail::message')
# Introduction

{{$name}} with the email {{$email}} sent this:
{{$message}}

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
