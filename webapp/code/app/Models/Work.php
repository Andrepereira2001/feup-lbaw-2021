<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Work
 * @package App\Models
 * @version April 6, 2018, 10:39 pm UTC
 *
 * @property \App\Models\Collection collection
 * @property \App\Models\User user
 * @property \Illuminate\Database\Eloquent\Collection authorWork
 * @property \Illuminate\Database\Eloquent\Collection book
 * @property \Illuminate\Database\Eloquent\Collection review
 * @property \Illuminate\Database\Eloquent\Collection Item
 * @property \App\Models\Nonbook nonbook
 * @property \Illuminate\Database\Eloquent\Collection loan
 * @property \Illuminate\Database\Eloquent\Collection wishList
 * @property string title
 * @property string obs
 * @property string img
 * @property integer year
 * @property integer id_user
 * @property integer id_collection
 */
class Work extends Model
{

    public $table = 'work';
    public $timestamps  = false;
    public $fillable = [
        'title',
        'obs',
        'img',
        'year',
        'id_user',
        'id_collection'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'obs' => 'string',
        'img' => 'string',
        'year' => 'integer',
        'id_user' => 'integer',
        'id_collection' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function collection()
    {
        return $this->belongsTo(\App\Models\Collection::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function authors()
    {
        return $this->belongsToMany(\App\Models\Author::class, 'author_work');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function publishers()
    {
        return $this->belongsToMany(\App\Models\Publisher::class, 'book');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function users()
    {
        return $this->belongsToMany(\App\Models\User::class, 'review');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function items()
    {
        return $this->hasMany(\App\Models\Item::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     **/
    public function nonbook()
    {
        return $this->hasOne(\App\Models\Nonbook::class);
    }
}
