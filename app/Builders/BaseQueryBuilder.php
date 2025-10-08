<?php

namespace App\Builders;

use App\Traits\PaginateAll;
use Illuminate\Database\Eloquent\Builder;

class BaseQueryBuilder extends Builder
{
    use PaginateAll;
}
