<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\QueryScope;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, QueryScope, SoftDeletes;

    protected $table = 'products';
    protected $fillable = [
        'cannonical',
        'product_catalogue_id',
        'code',
        'barcode',
        'measure',
        'weight',
        'mass',
        'description',
        'publish',
        'images',
        'allow_to_sell',
        'input_tax_id',
        'output_tax_id',
        'tax_status'
    ];

    protected $attributes = [
        'publish' => 1,
    ];

    protected $casts = [
        'images' => 'json',
    ];

    public function product_catalogues()
    {
        return $this->belongsTo(ProductCatalogue::class, 'product_catalogue_id', 'id');
    }

    public function warehouse()
    {
        return $this->belongsToMany(Warehouse::class, 'product_warehouse', 'product_id', 'warehouse_id')
        ->withPivot('quantity', 'cost')->withTimestamps();
    }
}
