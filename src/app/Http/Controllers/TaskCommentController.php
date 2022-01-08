<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\TaskComment;

class TaskCommentController extends Controller
{
    /**
     * Shows the comment for a given id.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id,Request $request)
    {
      $comment = TaskComment::find($id);
      $task = Task::find($comment->id_task);

      if(!Auth::guard('admin')->user()){
        $this->authorize('show', $comment);
      }

      return $comment;
    }

    /**
     * Creates a new comment.
     *
     * @return TaskComment The comment created.
     */
    public function create(Request $request)
    {
      $comment = new TaskComment();

      //$project = Project::find($request->input('projectId'));

      //$this->authorize('create', $project);

      error_log("entrei--------------------------------------------------------------------------------");

      $comment->content = $request->content;
      $comment->id_task = $request->taskId;
      $comment->id_user = $request->userId;

      error_log("$comment->content--------------------------------------------------------------------------------");

      $comment->save();

      return $comment;
    }

}
