<?php

namespace App\Models;

use App\Traits\QueryScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tax extends Model
{
    use HasFactory, QueryScope, SoftDeletes;

    protected $table = 'taxs';

    protected $fillable = [
        'name',
        'value',
        'code',
        'publish',
    ];

    protected $attributes = [
        'publish' => 2,
    ];


}
