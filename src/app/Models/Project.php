<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $table = 'project';
    public $timestamps = false;

    /**
     * The cards this user owns.
     */
    public function users() {
        return $this->belongsToMany(User::class, Participation::class, 'id_project', 'id_user')->withPivot('role', 'favourite');
    }

    // public function participations() {
    //     return $this->hasMany(Participation::class, 'id_project');
    // }

    public function tasks() {
        return $this->hasMany(Task::class, 'id_project');
    }

    public function forumMessages() {
        return $this->hasMany(ForumMessage::class, 'id_project');
    }

    public function notifications() {
        return $this->hasMany(Notification::class, 'id_project');
    }

    public function labels() {
        return $this->hasMany(Label::class, 'id_project');
    }

    public function invites() {
        return $this->hasMany(Invite::class, 'id_project');
    }
}
