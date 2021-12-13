<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $table = 'project';
    public $timestamps = false;

    public function user() {
    return $this->belongsTo('App\Models\User');
    }

    /**
     * Items inside this card
     */
    public function items() {
        return $this->hasMany('App\Models\Item');
    }

    /**
     * The cards this user owns.
     */
    public function users() {
        return $this->belongsToMany('App\Models\user', 'App\Models\participation', 'id_project', 'id_user')->withPivot('role', 'favourite');
    }
}
