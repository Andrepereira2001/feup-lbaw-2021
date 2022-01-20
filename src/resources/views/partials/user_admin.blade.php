<article class="user" data-id={{$user->id}}>
    @if($user->blocked)
        <div class="unblock">
    @else
        <div class="block">
    @endif
        <div class="user-info">
            @if($user->image_path != "./img/default")
                <img src="{{asset($user->image_path)}}" alt="User image" width="70" class="profilePhoto" >
            @else
                <span class="span profilePhoto">{{$user->name[0]}}</span>
            @endif

            <a href="/users/{{$user->id}}/profile">{{ $user->name }}</a>
        </div>

        <div class="buttons">
            @if($user->blocked)
                <button type="button" class="btn">Unblock</button>
            @else
                <button type="button" class="btn">Block</button>
            @endif
        </div>
    </div>
</article>

