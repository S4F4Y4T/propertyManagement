<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Filters\QueryFilter;
use App\Builders\BaseQueryBuilder;

class Main extends Model{
    public function scopeFilter(Builder $query, QueryFilter $filter): void
    {
        $filter->apply($query);
    }

    public function newEloquentBuilder($query)
    {
        return new BaseQueryBuilder($query);
    }
}

