<div class="modal fade" id={{$name}} tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-body">
            <a class="userIcon">
                <?php
                    if ($user->image_path != "./img/default") {
                    echo '<img src=' . asset($user->image_path) . ' class="profilePhoto" >';
                    }
                    else echo '<span class="profilePhoto"></span>';
                ?>
            </a>
            <div class="options">
                <button type="button" class="upload" selected>Upload photo</button>
                <button type="button" class="upload">Choose color</button>
            </div>
            <div class="colors">
                <input type="radio" id="yellow" name="color" value="yellow">
                <label for="yellow" class="yellow"></label>
                <input type="radio" id="red" name="color" value="red">
                <label for="red" class="red"></label>
                <input type="radio" id="blue" name="color" value="blue">
                <label for="blue" class="blue"></label>
                <input type="radio" id="pink" name="color" value="pink">
                <label for="pink" class="pink"></label>
            </div>
            <div class="uploadPhoto">
                {{-- <input type="email" name="email" placeholder="NOT IMPLEMENTED YET" value="{{ old('email') }}" required autofocus> --}}
                <input type="file" accept="image/png, image/gif, image/jpeg, image/jpg">
            </div>
        </div>
        <div class="modal-footer">
            <a class="btn confirm" href="{{ url('/users/' . $id .'/profile') }}">Save</a>
            <button type="button" class="btn cancel" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
</div>
