<div class="info-remove user" data-id={{$user->id}}>
    <div class="user-info">
        @if($user->image_path != "./img/default")
            <img src="{{asset($user->image_path)}}" alt="User image" width="55" class="profilePhoto" >
        @else
            <span class="span profilePhoto">{{$user->name[0]}}</span>
        @endif
        <a href="/users/{{$user->id}}/profile">{{ $user->name }}</a>
    </div>
    <button type="button" class="btn remove" data-id={{$user->id}}>Demote</button>
</div>
