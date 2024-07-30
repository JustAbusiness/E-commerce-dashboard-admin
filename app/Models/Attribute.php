<?php

namespace App\Models;

use App\Traits\QueryScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attribute extends Model
{
    use HasFactory, QueryScope, SoftDeletes;

    protected $table = 'attributes';

    protected $fillable = [
        'name',
        'code',
        'description',
        'publish',
        'attribute_catalogue_id',
    ];

    protected $attributes = [
        'publish' => 2,
    ];

    public function attribute_catalogues()
    {
        return $this->belongsTo(AttributeCatalogue::class, 'attribute_catalogue_id', 'id');
    }
}
