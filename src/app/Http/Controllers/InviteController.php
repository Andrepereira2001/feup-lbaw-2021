<?php

namespace App\Http\Controllers;



use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Mail\InviteMail;
use Illuminate\Support\Facades\Mail;



use App\Models\Invite;
use App\Models\Participation;
use App\Models\User;
use Illuminate\Support\Facades\App;

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
      Auth::check();

      $checkInvite = Invite::where('id_user', $request->id_user)->where('id_project',$request->id_project)->first();

      if($checkInvite){
        return "Invite already exists";
      }
      else {
          $invite = new Invite();

          $invite->id_user = $request->id_user;
          $invite->id_project = $request->id_project;

          $invite->save();

          $url = App::make('url')->to('users/'. $invite->id_user .'/notifications');

          Mail::to(User::find($invite->id_user)->email)->send(new InviteMail($invite, $url));

          return $invite;
      }
    }

    /**
     * Accepts an Invite.
     *
     * @param  Request  request
     *
     */
    public function accept($id){

        $invite = Invite::find($id);

        $participation = new Participation();
        $participation->id_user = $invite->id_user;
        $participation->id_project = $invite->id_project;
        $participation->role = 'Member';
        $participation->save();
        return $participation;
    }

    public function search(Request $request){
        $user_id = $request->id_user;
        $project_id = $request->id_project;
        $invite = Invite::where('id_user',$user_id)->where('id_project',$project_id)->first();
        return $invite;
    }

    public function delete($id){
        $invite = Invite::find($id);
        $invite->delete();

        return $invite;
      }
}
