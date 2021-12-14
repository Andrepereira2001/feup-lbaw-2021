<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $table ='notification';
    public $timestamps = false;

    /**
     * The project this notification belongs to.
     */
    public function project() {
        return $this->belongsTo('App\Models\project');
    }

    /**
     * The notifications this user has.
    */
    public function users() {
        return $this->belongsToMany(User::class, Seen::class, 'id_notification', 'id:user')->withPivot('seen');
    }
}
