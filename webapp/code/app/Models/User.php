<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 * @package App\Models
 * @version April 6, 2018, 10:36 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection authorWork
 * @property \Illuminate\Database\Eloquent\Collection book
 * @property \Illuminate\Database\Eloquent\Collection review
 * @property \Illuminate\Database\Eloquent\Collection item
 * @property \Illuminate\Database\Eloquent\Collection Work
 * @property \Illuminate\Database\Eloquent\Collection Loan
 * @property \Illuminate\Database\Eloquent\Collection wishList
 * @property string email
 * @property string name
 * @property string obs
 * @property string password
 * @property string img
 * @property boolean is_admin
 */
class User extends Authenticatable
{
    use Notifiable;
    public $table = 'users';
    public $timestamps  = false;
    public $fillable = [
        'email',
        'name',
        'obs',
        'password',
        'img',
        'is_admin'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'email' => 'string',
        'name' => 'string',
        'obs' => 'string',
        'password' => 'string',
        'img' => 'string',
        'is_admin' => 'boolean'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function reviews()
    {
        return $this->belongsToMany(\App\Models\Work::class, 'review');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function works()
    {
        return $this->hasMany(\App\Models\Work::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function loans()
    {
        return $this->hasMany(\App\Models\Loan::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function wishList()
    {
        return $this->belongsToMany(\App\Models\Work::class, 'wish_list');
    }

    /**
     * @return mixed
     */
    public function isAdmin() {
        return $this->is_admin;
    }
}
