<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumMessage extends Model
{
    use HasFactory;

    protected $table ='forummessage';
    public $timestamps = false;

    public function project() {
        //return $this->belongsTo('App\Models\project');
        return  $this->belongsTo(Project::class, 'id_project');
    }

    /**
     * The user this forum message belongs to.
     */
    public function user() {
        return $this->belongsTo(User::class, 'id_user');
    }
}
