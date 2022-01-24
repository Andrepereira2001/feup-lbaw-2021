@component('mail::message')
# New Invite

    {{$userName}}, You were invited to the project: {{$projectName}} , click on the button below to accept or decline the invitation.

@component('mail::button', ['url' => $url])
toEaseManage
@endcomponent
[logo] {{asset('/img/logo.png')}} "logo"

Thanks,<br>
{{ config('app.name') }}
@endcomponent
