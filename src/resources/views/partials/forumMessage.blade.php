<li class="forumMessage">
    @if($forumMessage->user->image_path != "./img/default")
        <img src="{{asset($forumMessage->user->image_path)}}" alt="User image" width="70px" class="profilePhoto" >
    @else
        <span class="profilePhoto"></span>
    @endif
    <div class="message">
        <div class="user-info">
            <span class="name">{{ $forumMessage->user->name }}</span>
            <span class="name">{{ substr($forumMessage->created_at,8,2). "/". substr($forumMessage->created_at,5,2) ." ". substr($forumMessage->created_at,11,2)."h". substr($forumMessage->created_at,14,2)}}</span>
        </div>
        <span class="number">{{ $forumMessage->content }}</span>
    </div>
</li>
