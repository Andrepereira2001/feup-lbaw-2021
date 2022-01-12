<div class="user" data-id={{$user->id}}>
    @if($user->image_path != "./img/default")
        <img src="{{asset($user->image_path)}}" alt="User image" width="70px" class="profilePhoto" >
    @else
        <span class="span profilePhoto">{{$user->name[0]}}</span>
    @endif
    <a href="/users/{{$user->id}}/profile">{{ $user->name }}</a>
</div>

