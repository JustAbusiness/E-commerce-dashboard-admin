<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\QueryScope;

class UserCatalogue extends Model
{
    use HasFactory, QueryScope;

    protected $fillable = [
        'name',
        'description',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'user_catalogue_id', 'id');
    }
}
