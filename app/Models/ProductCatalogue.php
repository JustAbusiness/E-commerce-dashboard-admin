<?php

namespace App\Models;

use App\Traits\QueryScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCatalogue extends Model
{
    use HasFactory, QueryScope, SoftDeletes;

    protected $table = 'product_catalogues';

    protected $fillable = [
        'name',
        'code',
        'description',
    ];  

    protected $attributes = [
        'publish' => 1,
    ];
}
