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
      $this->authorize('show', $task);

      //$search = $request->input('search');

      return view('pages.task', ['task' => $task, 'project' => $project]);
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

        $task->name = $request->name;
        $task->description = $request->description;
        $task->priority = $request->priority;
        $date = $request->input('dueDate');
        if($date != ""){
            $date = explode('-', $date);
            $date = implode('/',$date);
            $task->due_date = $date;
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
}
