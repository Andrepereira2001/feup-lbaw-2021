<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
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

      if(!Auth::guard('admin')->user()){
        $this->authorize('member', Project::find($comment->task->project->id));
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

        if(!Auth::guard('admin')->user()){
            $this->authorize('member', Project::find(Task::find($request->taskId)->project->id));
        }

        $comment->content = $request->content;
        $comment->id_task = $request->taskId;
        $comment->id_user = $request->userId;

        $comment->save();

        return $comment;
    }

}
