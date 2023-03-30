<?php

namespace App\Traits;

use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait Searchable
{

    /**
     * @throws Exception
     */
    public function scopeSearch(Builder $builder, $term = '')
    {
        if (!$this->searchable) {
            throw new Exception('Please define searchable array');
        }

        foreach ($this->searchable as $searchable) {

            if (str_contains($searchable, '.')) {

                $relation = Str::beforeLast($searchable, '.');

                $column = Str::afterLast($searchable, '.');

                $builder->orWhereRelation($relation, $column, 'like', "%$term%");

                continue;
            }

            $builder->orWhere($searchable, 'like', "%$term%");
        }
    }
}
