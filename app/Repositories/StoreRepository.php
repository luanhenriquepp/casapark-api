<?php

namespace App\Repositories;

use App\Models\Store;
use App\Purchase;
use Prettus\Repository\Eloquent\BaseRepository;
use App\Validators\PurchaseValidator;

/**
 * Class PurchaseRepository.
 *
 * @package namespace App\Repositories;
 */
class StoreRepository extends BaseRepository
{

    public $relationships = [

    ];

    protected $fieldSearchable = [];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Store::class;
    }

}
