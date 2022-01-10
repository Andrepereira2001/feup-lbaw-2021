<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Participation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Project;

class NotificationController extends Controller
{
    /**
     * Shows the user for a given id.
     *
     * @param  int  $id
     * @return Response
     */
    public function list($id)
    {
        $notifications = Auth::user()->notifications();
        // if(!Auth::guard('admin')->user()){
        //     // $this->authorize('show',$user);
        // }

        return view('pages.user', ['notifications' => $notifications, 'view' => "View"]);
    }

    public function project($id)
    {
        $notification = Notification::find($id);
        $project = Project::find($notification->id_project);
        // if(!Auth::guard('admin')->user()){
        // $this->authorize('show', $project);
        // }

        return view('pages.project', ['notification' => $notification, 'project' => $project]);
    }
}
