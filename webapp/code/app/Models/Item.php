<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Item
 * @package App\Models
 * @version April 6, 2018, 10:39 pm UTC
 *
 * @property \App\Models\Location location
 * @property \App\Models\Work work
 * @property \Illuminate\Database\Eloquent\Collection authorWork
 * @property \Illuminate\Database\Eloquent\Collection book
 * @property \Illuminate\Database\Eloquent\Collection review
 * @property \Illuminate\Database\Eloquent\Collection work
 * @property \Illuminate\Database\Eloquent\Collection Loan
 * @property \Illuminate\Database\Eloquent\Collection wishList
 * @property integer id_work
 * @property integer id_location
 * @property integer code
 * @property dateTimeTz date
 */
class Item extends Model
{
    public $table = 'item';
    public $timestamps  = false;
    public $fillable = [
        'id_work',
        'id_location',
        'code',
        'date'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'id_work' => 'integer',
        'id_location' => 'integer',
        'code' => 'integer',
        'date' => 'datetime'
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
    public function location()
    {
        return $this->belongsTo(\App\Models\Location::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function work()
    {
        return $this->belongsTo(\App\Models\Work::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function loans()
    {
        return $this->hasMany(\App\Models\Loan::class);
    }
}
