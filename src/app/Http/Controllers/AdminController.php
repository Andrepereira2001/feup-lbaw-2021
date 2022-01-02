<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;


class AdminController extends Controller
{
    /**
     * Shows the admin projects page.
     *
     * @return Response
     */
    public function showProjects(Request $request)
    {

        if(!Auth::guard('admin')->user()){
            abort(403, 'Access denied');
        }

        $checkbox = [
            "created_at" => false,
            "name" => false,
        ];

        $search = $request->input('search');
        $order = $request->input('order');


        if($search != ''):
            $projects = Project::whereRaw('tsvectors @@ plainto_tsquery(\'english\', ?)', $search)
                ->orderByRaw('ts_rank(tsvectors, plainto_tsquery(\'english\', ?)) DESC', $search)->get();
        elseif($order):
            $checkbox[$order] = "checked";
            $projects = Project::orderBy($order)->get();
        else:
            $projects = Project::all();
        endif;


        return view('pages.admin_projects', ['projects' => $projects] + $checkbox);
    }

    /**
     * Shows the admin users page.
     *
     * @return Response
     */
    public function showUsers()
    {
        if(!Auth::guard('admin')->user()){
            abort(403, 'Access denied');
        }

        $users = User::where('name', '!=', 'Anonymous')->get();
        return view('pages.admin_users', ['users' => $users]);
    }

}
