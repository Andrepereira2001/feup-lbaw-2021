<?php

namespace App\Http\Controllers;

use App\Models\Participation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

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
      $fname = strtok($user->name, " ");
      $lname = strrchr($user->name,' ');
      return view('pages.user', ['user' => $user, 'lname' => $lname, 'fname' => $fname, 'selected' => "selected-view", 'view' => "View"]);
    }

    public function edit($id)
    {
      $user = User::find($id);
      $fname = strtok($user->name, " ");
      $lname = strrchr($user->name,' ');
      return view('pages.userEdit', ['user' => $user, 'lname' => $lname, 'fname' => $fname, 'selected' => "selected-edit", 'view' => "Edit"]);
    }

    public function update(Request $request, $id)
    {
      $user = User::findOrFail($id);
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
    //   $this->authorize('delete', $user);

      $user->delete();

      return $user;
    }

    public function search(Request $request)
    {

        $search = $request->search;
        $notInProject = $request->notInProject;

        if($notInProject){
            $users = User::whereDoesntHave('projects', function($p) use($notInProject){
                $p->where('participation.id_project',$notInProject);;
            });
        }
        if($search){
            $users->where('name', 'ILIKE', "%${search}%")->orderBy('name', 'asc');
        }


      return $users->get();
    }

}
