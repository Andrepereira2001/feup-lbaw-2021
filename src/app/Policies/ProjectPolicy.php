<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Project;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class ProjectPolicy
{
    use HandlesAuthorization;

    public function show(User $user, Project $project)
    {
        // Only a participating member can see it

        foreach ($project->users as $val) {
            echo $val;
            if ($user->id == $val->id)
                return true;
        }
        return false;
    }

    public function list(User $user)
    {
      // Any user can list its own projects
      return Auth::check();
    }

    public function create(User $user)
    {
      // Any user can create a new project
      return Auth::check();
    }

    public function delete(User $user, Project $project)
    {
        // Only a project coordinator can delete it
        foreach ($project->users as $val) {
            if ($val->pivot->role == 'Coordinator')
                return true;
        }
        return false;
    }
}
