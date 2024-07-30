<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'name',
        'sku',
        'cost',
        'price',
        'weight',
        'mass',
        'price_wholesale'
    ];


    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function attributes()
    {
        return $this->belongsTo(Attribute::class, 'product_variant_attribute', 'product_variant_id', 'attribute_id');
    }
}
