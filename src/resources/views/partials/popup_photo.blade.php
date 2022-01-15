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
                <input id="file" type="file" accept="image/png, image/gif, image/jpeg, image/jpg" style="display:none">
                <label for="file" class="btn">Select Image</label>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn confirm" data-id={{$id}}>Save</button>
            <button type="button" class="btn cancel" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
</div>
