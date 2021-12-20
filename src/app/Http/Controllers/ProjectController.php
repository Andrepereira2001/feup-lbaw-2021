<?php

namespace App\Http\Controllers;

use App\Models\Participation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Project;

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
      $this->authorize('show', $project);
      return view('pages.project', ['project' => $project]);

      $search = $request->input('search');
      error_log($search);

      if($search != ''):
        $tasks->whereRaw('tsvectors @@ plainto_tsquery(\'english\', ?)', $search)
            ->orderByRaw('ts_rank(tsvectors, plainto_tsquery(\'english\', ?)) DESC', $search);
      endif;
    }

    /**
     * Shows the project details for a given id.
     *
     * @param  int  $id
     * @return Response
     */
    public function details($id){
        $project = Project::find($id);
        $this->authorize('show', $project);
        return view('pages.project_details', ['project' => $project]);
    }

    /**
     * Shows all projects.
     *
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

        $projects = $projects->get();

        return view('pages.projects', ['projects' => $projects] + $checkbox);
    }

    /**
     * Creates a new project.
     *
     * @return Project The project created.
     */
    public function create(Request $request)
    {
      $project = new Project();
      $participation = new Participation();

      $this->authorize('create', $project);

      $project->name = $request->input('name');
      $project->save();

      $participation->id_user = Auth::user()->id;
      $participation->id_project = $project->id;
      $participation->role = 'Coordinator';
      $participation->save();

      return $project;
    }

    public function delete(Request $request, $id)
    {
      $project = Project::find($id);
      $this->authorize('delete', $project);

      $project->delete();

      return $project;
    }

    public function favourite(Request $request, $id){

        $participation = Participation::where('id_project', $id)
                                        ->where('id_user', Auth::user()->id)->first();


        $participation->favourite = ! $participation->favourite ;
        $participation->save();

        return $participation;

    }

}
