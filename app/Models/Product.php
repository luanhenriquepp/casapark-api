<?php

namespace App;

use App\Models\Store;
use Illuminate\Support\Facades\Storage;

class Product extends AbstractModel
{
    protected $table = 'tb_product';
    protected $primaryKey = 'product_id';


    protected $fillable = [
        'product_name',
        'product_id',
        'path',
        'description',
        'price',
        'discount',
        'price_with_discount',
        'store_id'
    ];

    public function getUrlAttribute()
    {
        return Storage::disk('s3')->url($this->path);
    }
    protected $appends = [
        'url'
    ];

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }
}
