<?php

namespace App;

use App\Models\Store;

class Product extends AbstractModel
{
    protected $table = 'tb_product';
    protected $primaryKey = 'product_id';


    protected $fillable = [
        'product_name',
        'product_id',
        'product_name',
        'description',
        'price',
        'discount',
        'price_with_discount',
        'store_id'
    ];


    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }
}
