<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskComment extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table ='taskcomment';

    /**
     * The project this comment belongs to.
     */
    public function task() {
        return $this->belongsTo(Task::class, 'id_task');
    }

    /**
     * The user this task comment to.
     */
    public function user() {
        return $this->belongsTo(User::class, 'id_user');
    }
}
