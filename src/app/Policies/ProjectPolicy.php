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
        // Only a card owner can see it
        foreach ($project->users as &$val) {
            echo $val;
            if ($user->id == $val->pivot->id_user)
                return true;
        }
        return false;
    }

    public function list(User $user)
    {
      // Any user can list its own cards
      return Auth::check();
    }

    public function create(User $user)
    {
      // Any user can create a new card
      return Auth::check();
    }

    public function delete(User $user, Project $project)
    {
      // Only a card owner can delete it
      return $user->id == $project->user_id;
    }
}
