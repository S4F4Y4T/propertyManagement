<?php

namespace App\Models;

use App\Traits\Tenantable;

class Bill extends Main
{
    use Tenantable;

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(BillCategory::class, "bill_category_id");
    }

    public function flat()
    {
        return $this->belongsTo(Flat::class);
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}
