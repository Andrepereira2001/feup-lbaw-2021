<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumMessage extends Model
{
    use HasFactory;

    protected $table ='forumMessage';
    public $timestamps = false;

    /**
     * The project this comment belongs to.
     */
    public function project() {
        return $this->belongsTo(Project::class, 'id_project');
    }

    /**
     * The user this task comment to.
     */
    public function user() {
        return $this->belongsTo(User::class, 'id_user');
    }
}
