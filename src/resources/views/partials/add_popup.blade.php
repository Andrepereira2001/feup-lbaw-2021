<div class="modal fade" id={{$name}} tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">{{$title}}</h5>
        </div>
        <div class="modal-body">
            <div>
                <label for = "search"> <img alt="Search" src={{ asset('img/lupa.png') }} width="30px"> </label>
                <input class= "search" type="text" data-id={{$project_id}} name="search" placeholder="Search for User"/>
            </div>
            <div class="all-users">
                @each('partials.user_invite', $users, 'user')
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn close" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>
