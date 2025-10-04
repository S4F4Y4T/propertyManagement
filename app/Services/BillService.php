<?php

namespace App\Services;

use App\Models\Bill;
use App\Models\Flat;
use Illuminate\Auth\Access\AuthorizationException;

class BillService
{
    public function createBill(Flat $flat, array $billsData)
    {
        if ($flat->owner_id !== auth()->id()) {
            throw new AuthorizationException("Flat does not belong to the authenticated owner.");
        }

        if($flat->tenant_id === null) {
            throw new \Exception("Flat does not have an associated tenant.");
        }

        $preparedData = collect($billsData)->map(fn($bill) => array_merge($bill, [
            'tenant_id' => $flat->tenant_id,
            'owner_id'  => $flat->owner_id
        ]));

        $createdBills = $flat->bills()->createMany($preparedData->toArray());

        return $createdBills;
    }

}
