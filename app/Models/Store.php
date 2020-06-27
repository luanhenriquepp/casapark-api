<?php

namespace App\Models;

use App\Product;
use Illuminate\Support\Facades\Storage;

class Store extends AbstractModel
{
    protected $table = 'tb_store';
    protected $primaryKey = 'store_id';

    protected $fillable = [
        'store_name',
        'link_wpp'
    ];

    public function product()
    {
       return $this->hasMany(Product::class);
    }
}
