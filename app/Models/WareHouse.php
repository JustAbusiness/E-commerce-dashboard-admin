<?php

namespace App\Models;

use App\Traits\QueryScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WareHouse extends Model
{
    use HasFactory, QueryScope, SoftDeletes;

    protected $table = 'warehouses';

    protected $fillable = [
        'name',
        'code',
        'description',
        'publish',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_warehouse', 'warehouse_id', 'product_id')
        ->withPivot('quantity', 'cost')->withTimestamps();
    }
}
