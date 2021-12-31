<?php

namespace App\Http\Controllers;

use App\Models\Participation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


use App\Models\Project;
use App\Models\User;
use App\Models\Admin;
use App\Models\Interfaces\UserInterface;

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

      return view('pages.project', ['project' => $project, 'tasksDone' => $tasksDone, 'tasksTodo' => $tasksTodo]);
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

        return view('pages.projects', ['projects' => $projects /*, 'favouriteProjects'=> $favouriteProjects, 'archivedProjects'=> $archivedProjects, 'coordinatorProjects'=> $coordinatorProjects, 'memberProjects' => $memberProjects*/ ] + $checkbox);
    }

    /**
     * Show project creation form.
     *
     * @return Response
     */
    public function showCreate(){
        $user = Auth::user();
        return view('pages.project_create', ['user' => $user]);
    }

    /**
     * Creates a new project.
     *
     * @return Project The project created.
     */
    public function create(Request $request){
        Auth::check();
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

        Auth::check();
        $participation = Participation::where('id_project', $id)
                                        ->where('id_user', Auth::user()->id)->first();


        $participation->favourite = ! $participation->favourite ;
        $participation->save();

        return $participation;

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

        Auth::check();
        $participation = Participation::where('id_project', $id)
                                        ->where('id_user', Auth::user()->id)
                                        ->first()
                                        ->delete();

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
}
