<?php

namespace App\Http\Controllers\Api;

use App\Enums\PaymentStatusEnum;
use App\Filters\UserFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\HouseOwner\CreateOwnerRequest;
use App\Http\Requests\HouseOwner\UpdateOwnerRequest;
use App\Http\Resources\OwnerResource;
use App\Models\User;

class OwnerController extends Controller
{

    public function dashboard()
    {
        return [
            'total_flats' => auth()->user()->building->flats()->count(),
            'total_tenants' => auth()->user()->building->tenants()->count(),
            'total_unpaid_bills' => auth()->user()->building->bills()->where('payment_status', PaymentStatusEnum::UNPAID->value)->sum('total_amount'),
            'total_paid_bills' => auth()->user()->building->bills()->where('payment_status', PaymentStatusEnum::PAID->value)->sum('total_amount'),
        ];
    }

    public function index(UserFilter $ownerFilter)
    {
        return OwnerResource::collection(
            User::owners()->filter($ownerFilter)->paginate()
        );
    }

    public function store(CreateOwnerRequest $request)
    {
        $validated = $request->validatedData();

        $owner = User::create(
            collect($validated)->except('building')->toArray()
        );

        $owner->building()->create($validated['building']);

        return self::success(
            message: "House owner created successfully",
            data: OwnerResource::make($owner->load('building'))
        );
    }

    public function show(User $house_owner)
    {
        if(!$house_owner->isOwner()) {
            return self::error(message: "User is not a house owner", code: 404);
        }

        return OwnerResource::make($house_owner->load("building"));
    }

    public function update(UpdateOwnerRequest $request, User $house_owner)
    {
        if(!$house_owner->isOwner()) {
            return self::error(message: "User is not a house owner", code: 404);
        }

        $validated = $request->validatedData();

        $house_owner->update(
            collect($validated)->except('building')->toArray()
        );

        $house_owner->building()->update($validated['building']);

        return self::success(
            message: "House owner updated successfully",
            data: OwnerResource::make($house_owner->load('building'))
        );
    }

    public function destroy(User $house_owner)
    {
        if(!$house_owner->isOwner()) {
            return self::error(message: "User is not a house owner", code: 404);
        }

        $house_owner->delete();

        return self::success(message: "Owner deleted successfully");
    }
}