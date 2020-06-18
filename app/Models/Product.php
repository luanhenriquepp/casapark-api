<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
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
        'link_whatsapp',
        'price_with_discount'
    ];
}
