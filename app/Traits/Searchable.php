<?php

namespace App\Traits;

use App\Enums\UserRole;
use Exception;
use Illuminate\Database\Eloquent\Builder;
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

    public function scopeRole(Builder $builder)
    {

        if (auth()->user()->role->value != UserRole::ADMIN->value) {

            $builder->where('role', '=', auth()->user()->role);
        }
    }

}
