<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Filters\QueryFilter;

class Main extends Model{
    public function scopeFilter(Builder $query, QueryFilter $filter): void
    {
        $filter->apply($query);
    }
}

