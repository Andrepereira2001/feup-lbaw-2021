<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Project;
use App\Models\Participation;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;


class ProjectPolicy
{
    use HandlesAuthorization;

    public function show(User $user, Project $project)
    {

        foreach ($project->users as $val) {
            if ($user->id == $val->id)
                return true;
        }
        return true;
    }

    public function list(User $user)
    {
      // Any user can list its own projects
      return Auth::check();
    }

    public function create(User $user){
      // Any user can create a new project
      return Auth::check();
    }

    public function delete(User $user, Project $project){
        // Only a project coordinator can delete it
        return !$user->projects()->wherePivot("id_project",$project->id)->wherePivot("role","Coordinator")->get()->isEmpty();
    }

    public function edit(User $user, Project $project){
        // Only a project coordinator can edit it
        return !$user->projects()->wherePivot("id_project",$project->id)->wherePivot("role","Coordinator")->get()->isEmpty();
    }

    public function participant(User $user, Project $project){

        return !$user->projects()->wherePivot("id_project",$project->id)->get()->isEmpty();
    }

    public function participantControl(User $user, Participation $participation){

        $validate = !$user->projects()->wherePivot("id_project",$participation->id_project)->wherePivot("role","Coordinator")->get()->isEmpty();

        $validade2 = $user->id == $participation->id_user;

        if($validate || $validade2){
            error_log("________________________________-____________________________________________Boas");
        }
        else {
            error_log("aquiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii");
        }

        return $validate || $validade2;
    }
}
