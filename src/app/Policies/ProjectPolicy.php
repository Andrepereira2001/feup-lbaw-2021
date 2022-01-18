<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Project;


use Illuminate\Auth\Access\HandlesAuthorization;


class ProjectPolicy
{
    use HandlesAuthorization;

    public function show(User $user, Project $project)
    {
        if($user->projects()->find($project->id) || $user->invites()->where('id_project',$project->id)->first()){
            return true;
        }
        return false;
    }

    public function coordinator(User $user, Project $project){
        // Only a project coordinator can do it
        if($user->projects()->wherePivot("role","Coordinator")->find($project->id)){ return true; }
        return false;
    }

    public function member(User $user, Project $project){
        if($user->projects()->find($project->id)){ return true; }
        return false;
    }
}
