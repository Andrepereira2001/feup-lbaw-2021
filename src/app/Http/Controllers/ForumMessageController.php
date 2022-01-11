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
    public function show($id,Request $request)
    {
      $forumMessage = ForumMessage::find($id);
      $project = Project::find($forumMessage->id_project);

      if(!Auth::guard('admin')->user()){
        $this->authorize('show', $forumMessage);
      }

      //$search = $request->input('search');

      //return view('pages.project', ['forumMessage' => $forumMessage, 'project' => $project, 'selected' => "selected-view"]);
      return $forumMessage;
    }

    /**
     * Creates a new forumMessage.
     *
     * @return ForumMessage The forumMessage created.
     */
    public function create(Request $request)
    {
      $forumMessage = new ForumMessage();

      //$project = Project::find($request->input('projectId'));

      //$this->authorize('create', $project);

      error_log("entrei--------------------------------------------------------------------------------");

      $forumMessage->content = $request->content;
      $forumMessage->id_project = $request->projectId;
      $forumMessage->id_user = $request->userId;

      error_log("$forumMessage->content--------------------------------------------------------------------------------");

      $forumMessage->save();

      return $forumMessage;
    }

}
