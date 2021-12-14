<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    use HasFactory;

    protected $table ='invite';
    public $timestamps = false;

    /**
     * The project this task belongs to.
     */
    public function project() {
        return  $this->belongsTo(Project::class, 'id_project');
    }

    /**
     * The user this task belongs to.
     */
    public function user() {
        return $this->belongsTo(User::class, 'id_user');
    }

}
