<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Invite;
use App\Models\Participation;

class InviteController extends Controller
{

    /**
     * Creates a new Invite.
     *
     * @param  Request  request
     * @return Invite The invite created.
     */
    public function create(Request $request)
    {
      // $invite = new Invite();


      Auth::check();

    //   $invite->id_user = $request->id_user;
    //   $invite->id_project = $request->id_project;

    //   $invite->save();

        $participation = new Participation();
        $participation->id_user = $request->id_user;
        $participation->id_project = $request->id_project;
        $participation->role = 'Member';
        $participation->save();

      return $participation;
    }


}
