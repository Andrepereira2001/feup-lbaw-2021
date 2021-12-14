<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $table ='task';
    public $timestamps = false;

    /**
     * The project this task belongs to.
     */
    public function project() {
        //return $this->belongsTo('App\Models\project');
        return  $this->belongsTo(Project::class, 'id_project');
    }

    /**
     * The user this task belongs to.
     */
    public function user() {
        return $this->belongsTo(User::class, 'id_user');
    }

    /**
     * The user this task belongs to.
     */
    public function taskComments() {
        return $this->hasMany(TaskComment::class, 'id_task');
    }

     /**
     * The projects this user belongs.
     */
    public function labels() {
        return $this->belongsToMany(Label::class, TaskLabel::class, 'id_task', 'id_label');
    }
}
