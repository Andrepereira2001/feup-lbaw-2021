<li class="comment">
    @if($comment->user->image_path != "./img/default")
        <img src="{{asset($comment->user->image_path)}}" alt="User image" width="70px" class="profilePhoto" >
    @else
        <span class="profilePhoto"></span>
    @endif
    <div class="message">
        <div class="user-info">
            <a href="/users/{{$comment->id_user}}/profile" class="name">{{ $comment->user->name }}</a>
            <span class="date">{{ substr($comment->created_at,8,2). "/". substr($comment->created_at,5,2) ." ". substr($comment->created_at,11,2)."h". substr($comment->created_at,14,2)}}</span>
        </div>
        <span class="number">{{ $comment->content }}</span>
    </div>
</li>
