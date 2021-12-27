<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Project;
use App\Models\Task;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class TaskPolicy
{
    use HandlesAuthorization;

    public function show(User $user, Task $task)
    {
        // Only a participating member of the project can see it

        foreach ($task->project->users as $val) {
            if ($user->id == $val->id)
                return true;
        }
        return false;
    }

    //review
    public function list(User $user)
    {
      // Any user can list its own projects
      return Auth::check();
    }

    //review
    public function create(User $user)
    {
      // Any user can create a new project
      return Auth::check();
    }

    //review
    public function delete(User $user, Project $project)
    {
        // Only a project coordinator can delete it
        return !$user->projects()->wherePivot("id_project",$project->id)->wherePivot("role","Coordinator")->get()->isEmpty();
    }

    public function edit(User $user, Task $task)
    {
        // Only a project coordinator can edit it
        return !$user->projects()->wherePivot("id_project",$task->project->id)->get()->isEmpty();
    }
}
