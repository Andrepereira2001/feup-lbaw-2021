<article class="notification id-{{$notification->id}}" data-id="{{ $notification->id }}">
    @if (!$notification->seen)
    <style>
        #notifications article.notification {
            border-left: 5px solid #26C5B3;
            position: relative;
        }
        /* #notifications article.notification:hover {
            box-shadow: 0px 4px 4px rgb(0 0 0 / 25%), 0px 4px 4px rgb(0 0 0 / 25%), 0px 4px 4px rgb(0 0 0 / 25%);
        } */
    </style>
    @endif
    <div class="content">
        <div class="square"></div>
        <span>{{$notification->content}}</span>
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
    @endif
</article>
