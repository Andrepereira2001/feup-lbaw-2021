<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Task;

use Illuminate\Auth\Access\HandlesAuthorization;

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
    public function list(User $user, Task $task)
    {
      // Any member can list its own tasks
      return !$user->projects()->wherePivot("id_project",$task->project->id)->get()->isEmpty();
    }

    //review
    public function create(User $user, Task $project)
    {
      // Any user can create a new task
      return !$user->projects()->wherePivot("id_project",$project->id)->get()->isEmpty();
    }

    public function edit(User $user, Task $task)
    {
        // Only a project coordinator can edit it
        return !$user->projects()->wherePivot("id_project",$task->project->id)->get()->isEmpty();
    }
}
