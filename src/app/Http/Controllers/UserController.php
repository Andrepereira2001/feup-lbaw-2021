<?php

namespace App\Http\Controllers;

use App\Models\Participation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Project;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Shows the user for a given id.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $user = User::find($id);
        if(!Auth::guard('admin')->user()){
            $this->authorize('show',$user);
        }

        $fname = strtok($user->name, " ");
        $lname = strrchr($user->name,' ');
        return view('pages.user', ['user' => $user, 'lname' => $lname, 'fname' => $fname, 'selected' => "selected-view", 'view' => "View"]);
    }

    public function edit($id)
    {
        $user = User::find($id);
        if(!Auth::guard('admin')->user()){
            $this->authorize('edit', $user);
        }
        $fname = strtok($user->name, " ");
        $lname = strrchr($user->name,' ');
        return view('pages.userEdit', ['user' => $user, 'lname' => $lname, 'fname' => $fname, 'selected' => "selected-edit", 'view' => "Edit"]);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        if(!Auth::guard('admin')->user()){
            $this->authorize('edit', $user);
        }

        if ($request->input('password')) {
            $user->password = bcrypt($request->input('password'));
        }

        if ($request->input('name')) {
            $user->name = $request->input('name');
        }

        if ($request->input('email')) {
            $user->email = $request->input('email');
        }

        $user->save();

        return $user;
    }

    public function delete(Request $request, $id)
    {
      $user = User::find($id);

      if(!Auth::guard('admin')->user()){
        $this->authorize('delete', $user);
        Auth::logout();
      }


      $user->delete();

      return $user;
    }

    public function search(Request $request)
    {
        if(!Auth::guard('admin')->user()){
            $this->authorize('show', User::class);
        }

        $search = $request->search;
        $notInProject = $request->notInProject;
        $inProject = $request->inProject;
        $isMember = $request->isMember;

        if($inProject){
            $project = Project::find($inProject);
            $users = $project->users();
        }
        else if($notInProject){
            $users = User::whereDoesntHave('projects', function($p) use($notInProject){
                $p->where('participation.id_project',$notInProject);
            });
        }
        else{
            $users = User::query();
        }


        if($isMember){
            $users->wherePivot("role","Member");
        }
        if($search){
            $users->where('name', 'ILIKE', "%${search}%")->orderBy('name', 'asc');
        }


      return $users->get();
    }


    public function uploadImage($id, Request $request)
    {
        $user = User::find($id);

        if(!Auth::guard('admin')->user()){
            $this->authorize('edit', $user);
        }

        $file = $request->file('image');
        $color = $request->color;

        if($file || $color){
            if($user->image_path == "./img/default" ||
                $user->image_path == "./img/blue_photo.png" ||
                $user->image_path == "./img/pink_photo.png" ||
                $user->image_path == "./img/yellow_photo.png" ||
                $user->image_path == "./img/green_photo.png"
                ){}
            else {
                File::delete(public_path($user->image_path));
            }
        }

        if($file){
            $newImageName = time() . '.' . $file->extension();

            $file->move(public_path('img'), $newImageName);

            $user->image_path = './img/' . $newImageName;
        }
        else if($color == 'yellow'){
            $user->image_path = "./img/yellow_photo.png";
        }else if($color == 'blue'){
            $user->image_path = "./img/blue_photo.png";
        }else if($color == 'green'){
            $user->image_path = "./img/green_photo.png";
        }else if($color == 'pink'){
            $user->image_path = "./img/pink_photo.png";
        }

        $user->save();

        return redirect()->back();
    }
}
