@component('mail::message')
# Introduction

      {{$user->name}}, click on the button to reset your password.

@component('mail::button', ['url' => $link])
Reset
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
