<div class="user invite" data-id={{$user->id}}>
    <img src="https://picsum.photos/200" alt="User image" width="70px">
    <a href="/users/{{$user->id}}/profile">{{ $user->name }}</a>
    <button type="button" class="btn confirm" data-id={{$user->id}}>Add</button>
</div>

