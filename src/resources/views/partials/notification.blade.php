<article class="notification id-{{$notification->id}}" data-id="{{ $notification->id }}">
    <style>
    @if ($notification->pivot->seen == false)
        #notifications article.notification.id-{{$notification->id}} {
            border-left: 5px solid #26C5B3;
            position: relative;
        }
    @elseif ($notification->pivot->seen == true)

        #notifications article.notification.id-{{$notification->id}} {
            border-left: unset;
            position: relative;
        }
    @endif
        #notifications .square.id-{{$notification->id}} {
            background-color: {{$notification->color}};
        }

    </style>

    <a href="/projects/{{$notification->id_project}}">
        <div class="link content">
            <div class="square id-{{$notification->id}}"></div>
            <span class="not-content">{{$notification->content}}</span>
        </div>
        @if (Auth::user()->invites()->where('id_project',$notification->id_project)->first())
            <div class='not-buttons'>
                @if ($notification->content == "Invite to a new project!")
                    <button class="accept" data-id="{{$notification->id_project}}" type="submit">Accept</button>
                    <a class="cancel"  data-id="{{$notification->id_project}}">Decline</a>
                @else
                    <style>
                        #notifications article.notification.id-{{$notification->id}}:hover {
                            cursor:pointer;
                            box-shadow: 0px 4px 4px rgb(0 0 0 / 25%), 0px 4px 4px rgb(0 0 0 / 25%), 0px 4px 4px rgb(0 0 0 / 25%);
                        }
                    </style>
                @endif
            </div>
        @endif
    </a>
</article>
