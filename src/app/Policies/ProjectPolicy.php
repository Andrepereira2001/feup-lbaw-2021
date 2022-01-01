<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Project;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;


class ProjectPolicy
{
    use HandlesAuthorization;

//     public function __construct() {
//         error_log("_____________________________________________________Constructor");
//         if(Auth::guard('admin')->user()){
//             error_log("Admin");
//             $this->user = Auth::guard('admin')->user();
//         }
//         if(Auth::user()){
//             $this->user = Auth::user();
//         }

//         $this->provider = config('auth.guards.api.provider');

//    }

    // public function show(Project $project)
    // {
    //     // Only a participating member can see it
    //     // if (Auth::guard('admin')->user()) return true;

    //     foreach ($project->users as $val) {
    //         if (Auth::user()->id == $val->id)
    //             return true;
    //     }
    //     return false;
    // }

    public function show(User $user, Project $project)
    {

        // Only a participating member can see it
        // $admin = Auth::guard('admin')->user();
        // error_log("__________________________________________________________________________________$admin");
        // if(Auth::guard('admin')->user() != null) return true;

        // if($user->isAdmin()) return true;

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

    public function create(User $user)
    {
      // Any user can create a new project
      return Auth::check();
    }

    public function delete(User $user, Project $project)
    {
        // Only a project coordinator can delete it
        return !$user->projects()->wherePivot("id_project",$project->id)->wherePivot("role","Coordinator")->get()->isEmpty();
    }

    public function edit(User $user, Project $project)
    {
        // Only a project coordinator can edit it
        return !$user->projects()->wherePivot("id_project",$project->id)->wherePivot("role","Coordinator")->get()->isEmpty();
    }
}
