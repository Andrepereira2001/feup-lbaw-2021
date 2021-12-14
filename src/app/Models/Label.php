<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    use HasFactory;

    protected $table ='label';
    public $timestamps = false;

    /**
     * The project this lable belongs to.
    */
    public function project() {
        return $this->belongsTo('App\Models\project');
    }

    /**
     * The projects this user belongs.
    */
    public function tasks() {
        return $this->belongsToMany(Task::class, TaskLabel::class, 'id_label', 'id_task');
    }
}
