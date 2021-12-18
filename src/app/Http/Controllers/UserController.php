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
      $this->authorize('show', $user);
      return view('pages.user', ['user' => $user]);
    }

    // public function delete(Request $request, $id)
    // {
    //   $project = Project::find($id);
    //   $this->authorize('delete', $project);

    //   $project->delete();

    //   return $project;
    // }
}
