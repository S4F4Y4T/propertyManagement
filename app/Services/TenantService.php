<?php

namespace App\Services;

use App\Models\Tenant;
use App\Models\Flat;
use Illuminate\Validation\ValidationException;

class TenantService
{
    public function createTenant(array $data)
    {
        $tenantData = collect($data)->except('flat_id')->toArray();

        $tenant = Tenant::create($tenantData);

        if (!empty($data['flat_id'])) {
            $flat = Flat::findOrFail($data['flat_id']);

            if ($flat->owner_id != $data['owner_id']) {
                throw ValidationException::withMessages([
                    'flat_id' => ['The selected flat does not belong to the tenant\'s owner.']
                ]);
            }

            $flat->tenant_id = $tenant->id;
            $flat->save();
        }

        return $tenant->load('flat');
    }

    public function updateTenant(Tenant $tenant, array $data): Tenant
    {
        $tenantData = collect($data)->except('flat_id')->toArray();
        $tenant->update($tenantData);

        if (!empty($data['flat_id'])) {
            $flat = Flat::findOrFail($data['flat_id']);

            if ($flat->owner_id !== $tenant->owner_id) {
                throw ValidationException::withMessages([
                    'flat_id' => ['The selected flat does not belong to the tenant\'s owner.']
                ]);
            }

            $flat->tenant_id = $tenant->id;
            $flat->save();
        }

        return $tenant->load('flat');
    }

    public function deleteTenant(Tenant $tenant): Tenant
    {
        if ($tenant->flat) {
            $tenant->flat->tenant_id = null;
            $tenant->flat->save();
        }

        $tenant->delete();

        return $tenant;
    }

}
