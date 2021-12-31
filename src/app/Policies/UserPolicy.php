<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Project;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class ProjectPolicy
{
    use HandlesAuthorization;

    public function show(User $user)
    {
        return true;
    }

    public function delete(User $logedUser, User $user)
    {
        return $logedUser->id == $user->id;
    }
}
