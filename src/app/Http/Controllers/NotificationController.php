<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Participation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Project;

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
        $notification = Notification::find($id);
        if(!Auth::guard('admin')->user()){
            $this->authorize('show',$user);
        }

        $fname = strtok($user->name, " ");
        $lname = strrchr($user->name,' ');
        return view('pages.user', ['user' => $user, 'lname' => $lname, 'fname' => $fname, 'selected' => "selected-view", 'view' => "View"]);
    }
}
