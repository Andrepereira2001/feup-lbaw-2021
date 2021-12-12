<?php

namespace App\Repositories;

use App\Models\Loan;
use App\Repositories\BaseRepository;

/**
 * Class LoanRepository
 * @package App\Repositories
 * @version April 6, 2018, 10:39 pm UTC
 *
 * @method Loan findWithoutFail($id, $columns = ['*'])
 * @method Loan find($id, $columns = ['*'])
 * @method Loan first($columns = ['*'])
*/
class LoanRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id_item',
        'id_user',
        'start',
        'end'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Loan::class;
    }
}
