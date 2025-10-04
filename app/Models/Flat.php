<?php

namespace App\Models;

use App\Traits\Tenantable;

class Flat extends Main
{
    use Tenantable;

    protected $guarded = [];

    public function building()
    {
        return $this->belongsTo(Building::class);
    }

    public function bills()
    {
        return $this->hasMany(Bill::class);
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}
