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
    <a class="link" href="/projects/{{$notification->project_id}}">
        <div class="content">
            <div class="square id-{{$notification->id}}"></div>
            <span class="not-content">{{$notification->content}}</span>
        </div>
        @if (!$notification->seen)
        <div class='not-buttons'>
            @if ($notification->content == "Invite to a new project!")
                <button class="accept" type="submit">Accept</button>
                <a class="cancel">Decline</a>
            @else
                <style>
                    #notifications article.notification.id-{{$notification->id}}:hover {
                        cursor:pointer;
                        box-shadow: 0px 4px 4px rgb(0 0 0 / 25%), 0px 4px 4px rgb(0 0 0 / 25%), 0px 4px 4px rgb(0 0 0 / 25%);
                    }
                </style>
            @endif
        </div>
    </a>
    @endif
</article>
