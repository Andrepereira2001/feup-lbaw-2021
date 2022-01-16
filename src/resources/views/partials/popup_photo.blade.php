<div class="modal fade" id={{$name}} tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form action={{"/api/users/". $id . "/uploadImage"}} method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-body">
                    <a class="userIcon">
                        @if($user->image_path != "./img/default")
                        <img src="{{asset($user->image_path)}}" alt="User image" width="55px" class="profilePhoto" >
                        @else
                            <span class="span profilePhoto">{{$user->name[0]}}</span>
                        @endif
                    </a>
                    <div class="options">
                        {{-- <button type="button" class="upload" selected>Upload photo</button> --}}
                        <label for="file" class="btn upload">Upload photo</label>
                        <input id="file" type="file" name="image" style="display:none">

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
                </div>
                <div class="modal-footer">
                    <button type="submit" sclass="btn confirm">Save</button>
                    <button type="button" class="btn cancel" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>
