<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seen extends Model
{
    use HasFactory;

    protected $table ='seen';
    public $timestamps = false;

}
