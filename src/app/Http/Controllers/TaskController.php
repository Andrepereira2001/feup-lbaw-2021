<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Task;
use App\Models\Label;
use App\Models\TaskLabel;

class TaskController extends Controller
{
    /**
     * Shows the task for a given id.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id,Request $request)
    {
      $task = Task::find($id);
      $project = Project::find($task->id_project);

      if(!Auth::guard('admin')->user()){
        $this->authorize('show', $task);
      }

      $labelInProject = $project ->labels()->get();

      $taskLabels = TaskLabel::where('id_task', $id)->get();

      $notAssignedLabels = array();

      foreach ($labelInProject as &$val) {
        $taskLabel = TaskLabel::where('id_label', $val->id)->where('id_task','=' ,$id)->get();
        if(empty($taskLabel[0])){
            array_push($notAssignedLabels, $val);
        }
      }

      foreach ($notAssignedLabels as $val1) {
        //   echo $val1;
      }

      $comments = $task->taskComments()->orderBy("created_at", "ASC")->get();
      return view('pages.task', ['task' => $task, 'project' => $project, 'selected' => "selected-view", 'comments' => $comments, 'notAssigned' => $notAssignedLabels ]);
    }

    /**
     * Show task creation form.
     *
     * @return Response
     */
    public function showCreate($project_id){
        $project = Project::find($project_id);
        $user = Auth::user();
        if(!Auth::guard('admin')->user()){
            $this->authorize('create', $project);
        }

        return view('pages.task_create', ['user' => $user, 'project' => $project]);
    }

    /**
     * Creates a new task.
     *
     * @return Task The task created.
     */
    public function create(Request $request)
    {
      $task = new Task();

      $project = Project::find($request->input('projectId'));

      $this->authorize('create', $project);

      $task->name = $request->input('name');
      $task->description = $request->input('description');
      $task->priority = $request->input('priority');
      $task->id_project = $request->input('projectId');

      $date = $request->input('dueDate');
      if($date != ""){
        $date = explode('-', $date);
        $date = implode('/',$date);
        $task->due_date = $date;
      }

      $task->save();
      if($request->input('userId')){
        $task->id_user = $request->input('userId');
        $task->save();
      }

      return $task;
    }

     /**
     * Show task edit form.
     *
     * @param  int  $id
     * @return Task The project created.
     */
    public function editShow(Request $request, $id){

        $task = Task::find($id);
        if(!Auth::guard('admin')->user()){
            $this->authorize('edit', $task);
        }

        return view('pages.task_edit', ['task' => $task]);
    }

    /**
     * Edit the id task.
     *
     * @param Request $request
     * @param  int  $id
     * @return Task the task edited
     */
    public function edit(Request $request,$id){

        $task = Task::find($id);
        if(!Auth::guard('admin')->user()){
            $this->authorize('edit', $task);
        }

        if($request->name){
            $task->name = $request->name;
        }
        if($request->description){
            $task->description = $request->description;
        }
        if($request->priority){
            $task->priority = $request->priority;
        }
        if($request->dueDate){
            $date = $request->dueDate;
            if($date != ""){
                $date = explode('-', $date);
                $date = implode('/',$date);
                $task->due_date = $date;
            }
        }

        if($request->userId){
            $task->id_user = $request->userId;
        }

        $task->save();

        return $task;
    }

    /**
     * Complete the id task.
     *
     * @param Request $request
     * @param  int  $id
     * @return Task the task edited
     */
    public function complete(Request $request,$id){

        error_log($request->today);
        $task = Task::find($id);
        error_log($task->created_at);
        if(!Auth::guard('admin')->user()){
            $this->authorize('edit', $task);
        }
        error_log("INNNNNNNNNNNNNNNNNNNNNNNNNNNNN");
        $task->finished_at = $request->today;
        error_log($task->finished_at);
        $task->save();
        error_log("oi");

        return $task;
    }


  /**
     * Clone the id task.
     *
     * @param Request $request
     * @param  int  $id
     * @return Task the task cloned
     */
    public function clone(Request $request,$id){

        $original = Task::find($id);

        $task = new Task();
        if(!Auth::guard('admin')->user()){
            $this->authorize('edit', $original);
        }
        $task->id_project = $original->id_project;

        if($original->name){
            $task->name = $original->name;
        }
        if($original->description){
            $task->description = $original->description;
        }
        if($original->priority){
            $task->priority = $original->priority;
        }
        if($original->dueDate){
            $task->due_date = $original->due_date;

        }

        $task->save();
        if($request->userId){
            $task->id_user = $request->userId;
            $task->save();
        }

        return $task;
    }

    public function search(Request $request){
        Auth::check();
        $search = $request->search;
        $project = Project::find($request->project_id);
        $finished = $request->finished;
        $tasks = $project->tasks();

        if($finished == "false"){
            $tasks = $tasks->whereNull("finished_at");
        }

        if($search != ''){
            $tasks->whereRaw('tsvectors @@ plainto_tsquery(\'english\', ?)', $search)
                ->orderByRaw('ts_rank(tsvectors, plainto_tsquery(\'english\', ?)) DESC', $search);
        }

        return $tasks->get();
    }


}
