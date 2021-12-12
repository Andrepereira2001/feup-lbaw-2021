<?php

namespace App\Repositories;

use App\Models\Work;
use App\Repositories\BaseRepository;

/**
 * Class WorkRepository
 * @package App\Repositories
 * @version April 6, 2018, 10:39 pm UTC
 *
 * @method Work findWithoutFail($id, $columns = ['*'])
 * @method Work find($id, $columns = ['*'])
 * @method Work first($columns = ['*'])
*/
class WorkRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'obs',
        'img',
        'year',
        'id_user',
        'id_collection'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Work::class;
    }
}
