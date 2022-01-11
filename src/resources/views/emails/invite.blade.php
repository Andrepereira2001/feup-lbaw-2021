@component('mail::message')
# Introduction

      {{$userName}}, you were invited to this project {{$projectName}} , click on the button to accept

@component('mail::button', ['url' => $url])
Accept
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
