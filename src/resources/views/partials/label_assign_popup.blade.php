<div class="modal fade" id={{$name}} tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">{{$title}}</h5>
        </div>
        <div class="modal-body">
          <div class="all-labels">
            @each('partials.label_add', $notAssigned, 'label')
          </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn close" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>

