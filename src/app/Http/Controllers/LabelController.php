<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Label;
use App\Models\Task;
use App\Models\TaskLabel;

class LabelController extends Controller
{
    /**
     * Shows the forumMessage for a given id.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id,Request $request)
    {
      $label = Label::find($id);
      $project = Project::find($label->id_project);

      if(!Auth::guard('admin')->user()){
        $this->authorize('show', $project);
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
        error_log($request);
      $label = new Label();

      //$project = Project::find($request->input('projectId'));

      //$this->authorize('create', $project);

      //error_log("entrei--------------------------------------------------------------------------------");

      $label->name = $request->name;
      $label->id_project = $request->projectId;

      $label->save();

      return $label;
    }

    /**
     * Creates a new forumMessage.
     *
     * @return Label The forumMessage created.
     */
    public function assignToTask(Request $request)
    {
      $label = Label::find($request->input('labelId'));
      $task = Task::find($request->input('taskId'));

      error_log($label);
      error_log($task);

    //   $taskLabel = array('id_label' => $label->id, 'id_task' => $task->id);
      error_log($label);
      error_log($task);
        // print_r($taskLabel);
    //   TaskLabel::create($taskLabel);
      $taskLabel = new TaskLabel;

      $taskLabel->id_label =  $label->id;

      $taskLabel->id_task =  $task->id;
      $taskLabel->save();

      error_log($label);
      error_log($task);
      error_log($taskLabel);

      //$project = Project::find($request->input('projectId'));

      //$this->authorize('create', $project);

      //error_log("entrei--------------------------------------------------------------------------------");



      return $taskLabel;
    }

    public function delete(Request $request, $id)
    {
      $label = Label::find($id);
      $label->delete();
      return $id;
    }

}
