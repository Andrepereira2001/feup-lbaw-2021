<div class="user admin" data-id={{$user->id}}>
    @if($user->blocked)
        <div class="unblock">
    @else
        <div class="block">
    @endif

        @if($user->image_path != "./img/default")
            <img src="{{asset($user->image_path)}}" alt="User image" width="70px" class="profilePhoto" >
        @else
            <span class="profilePhoto"></span>
        @endif

        <a href="/users/{{$user->id}}/profile">{{ $user->name }}</a>

        <div class="buttons">
            @if($user->blocked)
                <button type="button" class="btn">Unblock</button>
            @else
                <button type="button" class="btn">Block</button>
            @endif
        </div>
    </div>
</div>

