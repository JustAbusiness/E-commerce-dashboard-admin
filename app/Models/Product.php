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
    ];

    protected $attributes = [
        'publish' => 1,
    ];

    public function product_catalogues()
    {
        return $this->belongsTo(ProductCatalogue::class, 'product_catalogue_id', 'id');
    }
}
