<?php

namespace App\Models;

use App\Traits\Tenantable;

class Tenant extends Main
{
    use Tenantable;

    protected $guarded = [];

    protected static function booted()
    {
        static::creating(function ($tenant) {
            $tenant->validateFlatOwnerMatch();
        });

        static::updating(function ($tenant) {
            $tenant->validateFlatOwnerMatch();
        });
    }

    protected function validateFlatOwnerMatch()
    {
        if (!empty($this->flat_id) && !empty($this->owner_id)) {
            $flat = Flat::find($this->flat_id);

            if (!$flat) {
                throw new \Exception("Flat not found.");
            }

            if ($flat->owner_id !== $this->owner_id) {
                throw new \Exception("The selected flat does not belong to the given owner.");
            }
        }
    }

    public function flat()
    {
        return $this->hasOne(Flat::class);
    }

    public function bills()
    {
        return $this->hasMany(Bill::class);
    }
    
}
