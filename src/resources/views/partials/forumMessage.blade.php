@if($forumMessage->id_user == Auth::user()->id)
    <li class="forumMessage2">
        <div class="message2">
            <span class="content2">{{ $forumMessage->content }}</span>
            <div class="user-info2">
                <span class="date">{{ substr($forumMessage->created_at,8,2). "/". substr($forumMessage->created_at,5,2) ." ". substr($forumMessage->created_at,11,2)."h". substr($forumMessage->created_at,14,2)}}</span>
                <a href="/users/{{$forumMessage->id_user}}/profile" class="name">{{ $forumMessage->user->name }}</a>
            </div>
        </div>
        @if($forumMessage->user->image_path != "./img/default")
        <img src="{{asset($forumMessage->user->image_path)}}" alt="User image" width="70px" class="profilePhoto" >
        @else
            <span class="profilePhoto"></span>
        @endif
    </li>
@else
<li class="forumMessage">
        @if($forumMessage->user->image_path != "./img/default")
            <img src="{{asset($forumMessage->user->image_path)}}" alt="User image" width="70px" class="profilePhoto" >
        @else
            <span class="profilePhoto"></span>
        @endif
        <div class="message">
            <span class="content">{{ $forumMessage->content }}</span>
            <div class="user-info">
                <a href="/users/{{$forumMessage->id_user}}/profile" class="name">{{ $forumMessage->user->name }}</a>
                <span class="date">{{ substr($forumMessage->created_at,8,2). "/". substr($forumMessage->created_at,5,2) ." - ". substr($forumMessage->created_at,11,2)."h". substr($forumMessage->created_at,14,2)}}</span>
            </div>
        </div>
    </li>
@endif
