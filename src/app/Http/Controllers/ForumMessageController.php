<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\ForumMessage;

class ForumMessageController extends Controller
{
    /**
     * Shows the forumMessage for a given id.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
      $forumMessage = ForumMessage::find($id);

      if(!Auth::guard('admin')->user()){
        $this->authorize('member', Project::find($forumMessage->project->id));
      }

      return $forumMessage;
    }

    /**
     * Creates a new forumMessage.
     *
     * @return ForumMessage The forumMessage created.
     */
    public function create(Request $request)
    {
        if(!Auth::guard('admin')->user()){
            $this->authorize('member', Project::find($request->projectId));
        }

      $forumMessage = new ForumMessage();

      $forumMessage->id_project = $request->projectId;
      $forumMessage->content = $request->content;
      $forumMessage->id_user = $request->userId;

      $forumMessage->save();

      return $forumMessage;
    }

}
