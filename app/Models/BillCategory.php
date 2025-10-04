<?php

namespace App\Models;

use App\Traits\Tenantable;

class BillCategory extends Main
{
    use Tenantable;

    protected $guarded = [];

    public function bills()
    {
        return $this->hasMany(Bill::class);
    }
}
