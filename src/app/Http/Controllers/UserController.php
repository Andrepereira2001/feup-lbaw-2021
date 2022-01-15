<?php

namespace App\Http\Controllers;

use App\Models\Participation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Project;
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

        $file = $request->file('image');

        error_log($file);
        error_log($request->formData);
        error_log($request->image);
        error_log($request->file);
        error_log($request->data);
        error_log($request->input('boas'));

        $file->store('images');

        //$ret = Storage::disk('local')->put('test.png', file_get_contents($file));

        return $file;
    }
}
