<div class="modal fade" id={{$name}} tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">{{$title}}</h5>
        </div>
        <div class="modal-body">
            <div>
                <label for = "search"> <img src={{ asset('img/lupa.png') }} width="30px"> </label>
                <input class= "search" type="text" data-id={{$project_id}} name="search" placeholder="Search for Label"/>
            </div>
            @each('partials.label', $project->labels()->orderBy('id')->get(), 'label')
        </div>
        <div class="modal-footer">
            <button type="button" class="btn cancel" data-dismiss="modal">OK</button>
            <button type="button" class="btn cancel" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
</div>




{{--
<div class="modal fade" id={{$name}} tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">{{$title}}</h5>
        </div>
        <div class="modal-body">
            <div>
                <label for = "search"> <img src={{ asset('img/lupa.png') }} width="30px"> </label>
                <input class= "search" type="text" data-id={{$project_id}} name="search" placeholder="Search for User"/>
            </div>
            @each('partials.user_invite', $users, 'user')
            <div>
                <label for="label"> Label name </label>
                <input class="label" type="text" name="label"/>
            </div>
        </div>
        <div class="modal-footer">
            <button type="click" class="btn save" data-dismiss="modal">Save</button>
            <button type="button" class="btn cancel" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
</div> --}}