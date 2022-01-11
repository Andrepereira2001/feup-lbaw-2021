<?php

namespace App\Http\Controllers;

use App\Models\ForumMessage;
use App\Models\Participation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


use App\Models\Project;
use App\Models\User;

class ProjectController extends Controller
{


    /**
     * Shows the project for a given id.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id,Request $request)
    {
        $project = Project::find($id);
        if(!Auth::guard('admin')->user()){
        $this->authorize('show', $project);
        }

        $search = $request->input('search');

        $tasksTodo = $project->tasks();
        if($search != ''):
        $tasksTodo->whereRaw('tsvectors @@ plainto_tsquery(\'english\', ?)', $search)
            ->orderByRaw('ts_rank(tsvectors, plainto_tsquery(\'english\', ?)) DESC', $search);
        endif;

        $tasksDone = $project->tasks()->whereNotNull("finished_at")->orderBy("finished_at", "DESC")->get();

        $tasksTodo = $project->tasks()->whereNull("finished_at")->get();

        $forumMessages = $project->forumMessages()->orderBy("created_at", "ASC")->get();

        return view('pages.project', ['project' => $project, 'tasksDone' => $tasksDone, 'tasksTodo' => $tasksTodo, 'forumMessages' => $forumMessages]);
    }

    /**
     * Shows the project details for a given id.
     *
     * @param  int  $id
     * @return Response
     */
    public function details($id){
        $project = Project::find($id);
        $isCoordinator = false;

        if(Auth::guard('admin')->user() == null){
            $this->authorize('show', $project);
            $isCoordinator = !Auth::user()->projects()->wherePivot("id_project",$project->id)->wherePivot("role","Coordinator")->get()->isEmpty();
        }
        $noMembers = User::whereDoesntHave('projects', function($p) use($id){
            $p->where('participation.id_project',$id);;
        })->get();

        return view('pages.project_details', ['project' => $project, 'isCoordinator' => $isCoordinator, 'noMembers' => $noMembers, 'selected' => "selected-view"]);
    }

    /**
     * Shows all projects.
     *
     * @param Request $request
     * @return Response
     */
    public function list(Request $request){

        if (!Auth::check()) return redirect('/login');
        $this->authorize('list', Project::class);


        $search = $request->input('search');
        $order = $request->input('order');
        $filters = $request->input('filters');

        $projects = Auth::user()->projects();

        $checkbox = [
            "archived" => false,
            "favourite" => false,
            "member" => false,
            "coordinator" => false,
            "created_at" => false,
            "name" => false,
        ];

        if($filters):
            if(in_array("archived",$filters)):
                $checkbox["archived"] = "checked";
                $projects->whereNotNull("archived_at");
            endif;
            if(in_array("favourite",$filters)):
                $checkbox["favourite"] = "checked";
                $projects->wherePivot("favourite",true);
            endif;
            if(in_array("member",$filters) && ! in_array("coordinator",$filters)):
                $checkbox["member"] = "checked";
                $projects->wherePivot("role","Member");
            endif;
            if(in_array("coordinator",$filters) && !in_array("member",$filters)):
                $checkbox["coordinator"] = "checked";
                $projects->wherePivot("role","Coordinator");
            endif;
        endif;

        if($search != ''):
            $projects->whereRaw('tsvectors @@ plainto_tsquery(\'english\', ?)', $search)
                ->orderByRaw('ts_rank(tsvectors, plainto_tsquery(\'english\', ?)) DESC', $search);
        elseif($order):
            $checkbox[$order] = "checked";
            $projects->orderBy($order);
        endif;

        /*--Todo on click search--*/

        // $favouriteProjects = $projects->wherePivot("favourite",true);
        // $archivedProjects = $projects->whereNotNull("archived_at");
        // $coordinatorProjects = $projects->wherePivot("role","Coordinator");
        // $memberProjects = $projects->wherePivot("role","Member");

        $projects = $projects->get();

        return view('pages.projects', ['projects' => $projects, 'search' => $search /*, 'favouriteProjects'=> $favouriteProjects, 'archivedProjects'=> $archivedProjects, 'coordinatorProjects'=> $coordinatorProjects, 'memberProjects' => $memberProjects*/ ] + $checkbox);
    }

    /**
     * Show project creation form.
     *
     * @return Response
     */
    public function showCreate(){
        if (!Auth::check()) return redirect('/login');
        $user = Auth::user();
        return view('pages.project_create', ['user' => $user]);
    }

    /**
     * Creates a new project.
     *
     * @return Project The project created.
     */
    public function create(Request $request){
        if (!Auth::check()) return redirect('/login');
        $project = new Project();
        $participation = new Participation();

        $this->authorize('create', $project);

        $project->name = $request->input('name');
        $project->description = $request->input('description');
        $project->color = $request->input('color');
        $project->save();

        $participation->id_user = Auth::user()->id;
        $participation->id_project = $project->id;
        $participation->role = 'Coordinator';
        $participation->save();

        return $project;
    }

    /**
     * Deletes the project for a given id.
     *
     * @param  int  $id
     * @return Project the project deleted
     */
    public function delete($id){
      $project = Project::find($id);

      if(!Auth::guard('admin')->user()){
        $this->authorize('delete', $project);
        }
      $project->delete();

      return $project;
    }

    /**
     * Favourits the id project.
     *
     * @param  int  $id
     * @return Participation the participation favourited
     */
    public function favourite($id){
        if (!Auth::check()) return redirect('/login');
        $project = Project::find($id);

        if(!Auth::guard('admin')->user()){
            $this->authorize('participant', $project);
        }

        $participation = Participation::where('id_project', $id)
                                        ->where('id_user', Auth::user()->id)->first();


        $participation->favourite = ! $participation->favourite ;
        $participation->save();

        return $participation;

    }

    /**
     * Archives the id project.
     *
     * @param  int  $id
     * @return Project the project archived
     */
    public function archive($id){
        if (!Auth::check()) return redirect('/login');
        $project = Project::find($id);

        if(!Auth::guard('admin')->user()){
            $this->authorize('archive', $project);
        }

        $project->archived_at = date('Y-m-d h:i:sa');
        $project->save();

        return $project;
    }

     /**
     * Show project edit form.
     *
     * @param  int  $id
     * @return Project The project created.
     */
    public function editShow(Request $request, $id){

        $project = Project::find($id);
        $this->authorize('edit', $project);

        return view('pages.project_edit', ['project' => $project]);
    }

    /**
     * Edit the id project.
     *
     * @param Request $request
     * @param  int  $id
     * @return Project the project edited
     */
    public function edit(Request $request,$id){

        $project = Project::find($id);
        $this->authorize('edit', $project);

        $project->name = $request->name;
        $project->description = $request->description;
        $project->color = $request->color;
        $project->save();

        return $project;

    }


    /**
     * Leave the id project.
     *
     * @param  int  $id
     * @return Participation the participation favourited
     */
    public function leave($id){
        if (!Auth::check()) return redirect('/login');
        $project = Project::find($id);
        $this->authorize('participant', $project);

        $participation = Participation::where('id_project', $id)
                                        ->where('id_user', Auth::user()->id)
                                        ->first();

        if($participation->role == "Coordinator"){
            if(Participation::where('id_project', $id)->where("id_user", '!=', Auth::user()->id)->where("role","Coordinator")->first()){
                $participation->delete();
            }
            else {
                abort(406, 'Not Acceptable');
            }
        }else {
            $participation->delete();
        }

        return $participation;

    }

    /**
     * Add a coordinator.
     *
     * @param  Request  request
     * @return User Added to coordinator.
     */
    public function addCoordinator(Request $request){

        $project = Project::find($request->id_project);

        $this->authorize('edit',$project);

        $participation = Participation::where('id_project', $request->id_project)
                                        ->where('id_user', $request->id_user)
                                        ->first();

        $participation->role = 'Coordinator';
        $participation->save();

        return User::find($request->id_user);
    }


    /**
     * Leave the id project.
     *
     * @param  int  $id
     * @param  Request
     * @return Participation the participation favourited
     */
    public function decreaseParticipation(Request $request, $id){
        if (!Auth::check()) return redirect('/login');
        $user_id = $request->user_id;

        $participation = Participation::where('id_project', $id)
                                        ->where('id_user', $user_id)
                                        ->first();

        //$this->authorize('participantControl', $participation);

        if($participation->role == "Coordinator"){
            if(Participation::where('id_project', $id)->where("id_user", '!=', $user_id)->where("role","Coordinator")->first()){
                $participation->role = "Member";
                $participation->save();
            }
            else {
                abort(406, 'Not Acceptable');
            }
        }else {
            $participation->delete();
        }

        $member = User::find($user_id);

        return $member;
    }

    /**
     * Search all projects.
     *
     * @param Request $request
     * @return Response
     */
    public function search(Request $request){

        if (!Auth::check()) return redirect('/login');
        $this->authorize('list', Project::class);


        $search = $request->search;
        $order = $request->order;

        $favourite=false;
        $coordinator=false;
        $member=false;
        $archived=false;
        if($request->favourite == "true") $favourite=true;
        if($request->coordinator == "true") $coordinator=true;
        if($request->member == "true") $member=true;
        if($request->archived == "true") $archived=true;

        $projects = Auth::user()->projects();

        if($archived){
            $projects->whereNotNull("archived_at");
        }
        if($favourite){
            $projects->wherePivot("favourite",true);
        }
        if($member && ! $coordinator){
            $projects->wherePivot("role","Member");
        }
        if($coordinator && !$member){
            $projects->wherePivot("role","Coordinator");
        }

        if($search != ''):
            $projects->whereRaw('tsvectors @@ plainto_tsquery(\'english\', ?)', $search)
                ->orderByRaw('ts_rank(tsvectors, plainto_tsquery(\'english\', ?)) DESC', $search);
        elseif($order != 'null'):
            $checkbox[$order] = "checked";
            $projects->orderBy($order);
        endif;

        $projects = $projects->get();

        return $projects;
    }

}
