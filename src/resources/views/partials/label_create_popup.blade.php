<div class="modal fade" id={{$name}} tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">{{$title}}</h5>
        </div>
        <div class="modal-body">
            <div>
                <label for="label"> Label name </label>
                <input class="search" type="text" name="label"/>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn save" data-dismiss="modal">Save</button>
            <button type="button" class="btn cancel" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
</div>
