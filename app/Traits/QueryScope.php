<?php

namespace App\Traits;


trait QueryScope
{
    public function scopeKeyWord($query, $keyword, $fieldSearch = [])
    {
        if (!empty($keyword)) {
            if (count($fieldSearch)) {
                foreach ($fieldSearch as $key => $value) {
                    $query->orWhere($value, 'LIKE', '%' . $keyword . '%');
                }
            }
        }
    }

    public function scopePublish($query, $publish)
    {
        if(!empty($publish) && $publish != 0) {    // For Select value
            $query->where('publish', '=', $publish);
        }
    }


    // Scope for count relation
    public function scopeRelationCount($query, $relation)
    {
        if (!empty($relation)) {
            foreach ($relation as $key => $value) {
                $query->withCount($value);
            }
        }
        return $query;
    }
}
