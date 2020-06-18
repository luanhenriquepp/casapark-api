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
        'user'
    ];

    protected $fieldSearchable = [
        'product_name' => 'ilike',
        'description'=> 'ilike'
    ];

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
