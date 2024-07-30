<?php

namespace App\Models;

use App\Traits\QueryScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AttributeCatalogue extends Model
{
    use HasFactory, QueryScope, SoftDeletes;

    protected $table = 'attribute_catalogues';

    protected $fillable = [
        'name',
        'code',
        'description',
        'publish',
    ];

    protected $attributes = [
        'publish' => 2,
    ];

    public function attributes()
    {
        return $this->hasMany(Attribute::class, 'attribute_catalogue_id', 'id');
    }
}
