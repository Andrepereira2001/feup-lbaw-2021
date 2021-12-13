<?php

namespace App\Http\Controllers;

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
    public function show($id)
    {
      $project = Project::find($id);
      $this->authorize('show', $project);
      return view('pages.project', ['project' => $project]);
    }

    /**
     * Shows all projects.
     *
     * @return Response
     */
    public function list()
    {
      if (!Auth::check()) return redirect('/login');
      $this->authorize('list', Project::class);
      $projects = Auth::user()->projects()->orderBy('id')->get();
      return view('pages.projects', ['projects' => $projects]);
    }

    /**
     * Creates a new project.
     *
     * @return Project The project created.
     */
    public function create(Request $request)
    {
      $project = new Project();

      $this->authorize('create', $project);

      $project->name = $request->input('name');
      $project->user_id = Auth::user()->id;
      $project->save();

      return $project;
    }

    public function delete(Request $request, $id)
    {
      $project = Project::find($id);

      $this->authorize('delete', $project);
      $project->delete();

      return $project;
    }
}
