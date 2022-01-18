<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Label;
use App\Models\Task;
use App\Models\TaskLabel;

use App\Http\Controllers\Response;

class LabelController extends Controller
{
  /**
   * Shows the forumMessage for a given id.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    $label = Label::find($id);
    $project = Project::find($label->id_project);

    if(!Auth::guard('admin')->user()){
      $this->authorize('member', $project);
    }

    return $label;
  }

  /**
   * Creates a new Label.
   *
   * @return Label The forumMessage created.
   */
  public function create(Request $request)
  {

    if(!Auth::guard('admin')->user()){
        $this->authorize('coordinator', Project::find($request->input('projectId')));
    }

    $label = new Label();

    $labels = Project::find($request->input('projectId'))->labels()->where('name', $request->name)->first();

    if($labels){
        return "Label already exists";
    } else {

      $label->name = $request->name;
      $label->id_project = $request->projectId;

      $label->save();

      return $label;
    }
  }

  /**
   * Creates a new forumMessage.
   *
   * @return Label The forumMessage created.
   */
    public function assignToTask(Request $request)
    {
        if(!Auth::guard('admin')->user()){
            $this->authorize('member', Project::find(Label::find($request->input('labelId'))->id_project));
        }

        $label = Label::find($request->input('labelId'));
        $task = Task::find($request->input('taskId'));

        $taskLabel = new TaskLabel;

        $taskLabel->id_label =  $label->id;

        $taskLabel->id_task =  $task->id;
        $taskLabel->save();

        return $taskLabel;
    }

    public function delete($id)
    {

        $label = Label::find($id);
        if(!Auth::guard('admin')->user()){
            $this->authorize('coordinator', Project::find($label->id_project));
        }

        $label->delete();
        return $id;
    }

}
