<?php

namespace App\Repositories;

use App\Models\Product;
use App\Purchase;
use Prettus\Repository\Eloquent\BaseRepository;
use App\Validators\PurchaseValidator;

/**
 * Class PurchaseRepository.
 *
 * @package namespace App\Repositories;
 */
class ProductRepository extends BaseRepository
{

    public $relationships = [
        'store'
    ];

    protected $fieldSearchable = [];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Product::class;
    }

}
