<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Models\Interfaces\UserInterface;

class User extends Authenticatable implements UserInterface
{
    use Notifiable;

    // Don't add create and update timestamps in database.
    public $timestamps  = false;
    protected $table ='users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isAdmin(){
        return false;
    }

    /**
     * The cards this user owns.
     */
     public function cards() {
      return $this->hasMany('App\Models\Card');
    }

    /**
     * The projects this user belongs.
     */
    public function projects() {
        return $this->belongsToMany(Project::class, Participation::class, 'id_user', 'id_project')->withPivot('role', 'favourite');
    }

    public function tasks() {
        return $this->hasMany(Task::class, 'id_user');
    }

    public function forumMessages() {
        return $this->hasMany(ForumMessage::class, 'id_user');
    }

    public function invites() {
        return $this->hasMany(Invite::class, 'id_user');
    }

    public function taskComments() {
        return $this->hasMany(TaskComment::class, 'id_user');
    }

     /**
     * The notifications this user has.
     */
    public function notifications() {
        return $this->belongsToMany(Notification::class, Seen::class, 'id_user', 'id_notification')->withPivot('seen');
    }


}
