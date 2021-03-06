<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Participation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Project;
use App\Models\Seen;

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
        $user = User::find($id);

        if(!Auth::guard('admin')->user()){
            if(!Auth::check()){
                return redirect('/login');
            }
            $this->authorize('self', $user);
        }

        $notifications = $user->notifications();

        return view('pages.user', ['notifications' => $notifications, 'view' => "View"]);
    }

    public function showNotifications($id)
    {
        $user = User::find($id);

        if(!Auth::guard('admin')->user()){
            if(!Auth::check()){
                return redirect('/login');
            }
            $this->authorize('self', $user);
        }


        $notifications = $user->notifications();
        $notifications = $notifications->orderBy("created_at", "DESC")->get();
        foreach ($notifications as &$not) {
            $color = Project::find($not->id_project)->color;
            $not->color = $color;
        }

        return view('pages.notifications', ['user' => $user, 'notifications' => $notifications, 'view' => "View", 'selected' => "selected-edit"]);
    }

    public function seen(Request $request)
    {
        if(!Auth::guard('admin')->user()){
            $this->authorize('self', User::find($request->user_id));
        }

        $seen = Seen::where('id_notification', $request->notification_id)->where('id_user', $request->user_id)->first();

        $seen->seen = true;

        $seen->save();
        $projectId = Notification::where('id',$request->notification_id)->first();

        return $projectId->id_project;
    }
}
