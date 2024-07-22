<?php

namespace App\Traits;


trait QueryScope
{
    public function scopeRelationCount($query, $relation)
    {
        if(!empty($relation)){
            foreach($relation as $key => $value){
                $query->withCount($value);
            }
        }
        return $query;
    }
}
