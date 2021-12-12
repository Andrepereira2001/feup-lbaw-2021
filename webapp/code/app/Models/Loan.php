<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Loan
 * @package App\Models
 * @version April 6, 2018, 10:39 pm UTC
 *
 * @property \App\Models\Item item
 * @property \App\Models\User user
 * @property \Illuminate\Database\Eloquent\Collection authorWork
 * @property \Illuminate\Database\Eloquent\Collection book
 * @property \Illuminate\Database\Eloquent\Collection review
 * @property \Illuminate\Database\Eloquent\Collection item
 * @property \Illuminate\Database\Eloquent\Collection work
 * @property \Illuminate\Database\Eloquent\Collection wishList
 * @property integer id_item
 * @property integer id_user
 * @property dateTimeTz start
 * @property dateTimeTz end
 */
class Loan extends Model
{
    public $table = 'loan';
    public $timestamps  = false;
    public $fillable = [
        'id_item',
        'id_user',
        'start',
        'end'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'id_item' => 'integer',
        'id_user' => 'integer',
        'start' => 'datetime',
        'end' => 'datetime'
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
    public function item()
    {
        return $this->belongsTo(\App\Models\Item::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
