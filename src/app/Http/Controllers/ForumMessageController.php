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
     * Show task creation form.
     *
     * @return Response
     */
    // public function showCreate($project_id){
    //     $project = Project::find($project_id);
    //     $user = Auth::user();
    //     if(!Auth::guard('admin')->user()){
    //         $this->authorize('create', $project);
    //     }

    //     return view('pages.task_create', ['user' => $user, 'project' => $project]);
    // }

    /**
     * Creates a new forumMessage.
     *
     * @return Task The task created.
     */
    public function create(Request $request)
    {
      $forumMessage = new ForumMessage();

      $project = Project::find($request->input('projectId'));

      $this->authorize('create', $project);

      $forumMessage->content = $request->input('content');
      $forumMessage->id_project = $request->input('projectId');
      $forumMessage->id_user = $request->input('userId');
    //   $date = $request->input('dueDate');
    //   if($date != ""){
    //     $date = explode('-', $date);
    //     $date = implode('/',$date);
    //     $forumMessage->due_date = $date;
    //   }

      $forumMessage->save();

      return $forumMessage;
    }

     /**
     * Show task edit form.
     *
     * @param  int  $id
     * @return Task The project created.
     */
    // public function editShow(Request $request, $id){

    //     $task = Task::find($id);
    //     if(!Auth::guard('admin')->user()){
    //         $this->authorize('edit', $task);
    //     }

    //     return view('pages.task_edit', ['task' => $task]);
    // }

    /**
     * Edit the id task.
     *
     * @param Request $request
     * @param  int  $id
     * @return Task the task edited
     */
    // public function edit(Request $request,$id){

    //     $task = Task::find($id);
    //     if(!Auth::guard('admin')->user()){
    //         $this->authorize('edit', $task);
    //     }

    //     if($request->name){
    //         $task->name = $request->name;
    //     }
    //     if($request->description){
    //         $task->description = $request->description;
    //     }
    //     if($request->priority){
    //         $task->priority = $request->priority;
    //     }
    //     if($request->dueDate){
    //         $date = $request->dueDate;
    //         if($date != ""){
    //             $date = explode('-', $date);
    //             $date = implode('/',$date);
    //             $task->due_date = $date;
    //         }
    //     }
    //     if($request->userId){
    //         $task->id_user = $request->userId;
    //     }

    //     $task->save();

    //     return $task;
    // }
    // É Suposto?
    // public function search(Request $request){
    //     Auth::check();
    //     $search = $request->search;
    //     $project = Project::find($request->project_id);
    //     $finished = $request->finished;
    //     $tasks = $project->tasks();

    //     if($finished == "false"){
    //         $tasks = $tasks->whereNull("finished_at");
    //     }

    //     if($search != ''){
    //         $tasks->whereRaw('tsvectors @@ plainto_tsquery(\'english\', ?)', $search)
    //             ->orderByRaw('ts_rank(tsvectors, plainto_tsquery(\'english\', ?)) DESC', $search);
    //     }

    //     return $tasks->get();
    // }


}
