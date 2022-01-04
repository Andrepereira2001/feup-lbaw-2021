<?php

namespace App\Policies;

use App\Models\User;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class UserPolicy
{
    use HandlesAuthorization;

    public function show(User $logedUser)
    {
        Auth::check();
        return true;
    }

    public function edit(User $logedUser, User $user)
    {
        return $logedUser->id == $user->id;
    }

    public function delete(User $logedUser, User $user)
    {
        return $logedUser->id == $user->id;
    }
}
