<div class="user invite" data-id={{$user->id}}>
    <?php
        if ($user->image_path != "./img/default") {
            echo '<img src=' . asset($user->image_path) . ' alt="User image" width="70px" class="profilePhoto" >';
        }
        else echo '<span class="profilePhoto"></span>';
    ?>
    <a href="/users/{{$user->id}}/profile">{{ $user->name }}</a>
    <button type="button" class="btn confirm" data-id={{$user->id}}>Add</button>
</div>

