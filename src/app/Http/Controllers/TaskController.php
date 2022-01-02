<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Task;

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

      //$search = $request->input('search');

      return view('pages.task', ['task' => $task, 'project' => $project, 'selected' => "selected-view"]);
    }

    /**
     * Show task creation form.
     *
     * @return Response
     */
    public function showCreate($project_id){
        $project = Project::find($project_id);
        $user = Auth::user();
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

      $this->authorize('create', $task);

      $task->name = $request->input('name');
      $task->description = $request->input('description');
      $task->priority = $request->input('priority');
      $task->id_project = $request->input('projectId');
      $task->id_user = $request->input('userId');
      $date = $request->input('dueDate');
      if($date != ""){
        $date = explode('-', $date);
        $date = implode('/',$date);
        $task->due_date = $date;
      }

      $task->save();

      return $task;
    }

    //review
    /**
     * Deletes the task for a given id.
     *
     * @param  int  $id
     * @return Task the project deleted
     */
    public function delete(Request $request, $id){
      $task = Task::find($id);
      $this->authorize('delete', $task);

      $task->delete();

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
        $this->authorize('edit', $task);

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
        $this->authorize('edit', $task);

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

      $task = Task::find($id);
      $this->authorize('edit', $task);

      $task->finished_at = $request->today;
      $task->save();

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
        $this->authorize('edit', $original);
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
        $task->id_user = $request->userId;
        $task->save();

        return $task;
    }


    public function search(Request $request){
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
