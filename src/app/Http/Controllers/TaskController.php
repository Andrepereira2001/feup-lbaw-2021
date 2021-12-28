<?php

namespace App\Http\Controllers;

use App\Models\Participation;
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
      $this->authorize('show', $task);

      //$search = $request->input('search');

      return view('pages.task', ['task' => $task]);
    }

    //review
    /**
     * Show task creation form.
     *
     * @return Response
     */
    public function showCreate(){
        $user = Auth::user();
        //project?
        return view('pages.task_create', ['user' => $user]);
    }

    //review
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
      $task->save();

      //Save who is task assigned to

    //   $participation->id_user = Auth::user()->id;
    //   $participation->id_project = $project->id;
    //   $participation->role = 'Coordinator';
    //   $participation->save();

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
        $task->save();

        return $task;

    }
}
