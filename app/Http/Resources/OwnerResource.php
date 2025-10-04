<?php

namespace App\Http\Resources;

use App\Enums\RoleEnum;
use App\Filters\UserFilter;
use App\Http\Requests\HouseOwner\CreateOwnerRequest;
use App\Http\Requests\HouseOwner\UpdateOwnerRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\User;

class OwnerResource extends JsonResource
{
     public function index(UserFilter $ownerFilter)
    {
        return OwnerResource::collection(
            User::query()
            ->where('role', RoleEnum::OWNER->value)
            ->filter($ownerFilter)
            ->paginate()
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
            message: "Owner created successfully",
            data: TenantResource::make($owner->load('building'))
        );
    }

    public function show(User $owner)
    {
        if($owner->role !== RoleEnum::OWNER->value) {
            return self::error(message: "Owner not found", status: 404);
        }

        return TenantResource::make($owner->load('building'));
    }

    public function update(UpdateOwnerRequest $request, User $owner)
    {
        if($owner->role !== RoleEnum::OWNER->value) {
            return self::error(message: "Owner not found", status: 404);
        }

        $validated = $request->validatedData();
        
        $owner->update(collect($validated)->except('building')->toArray());
        $owner->building()->update($validated['building']);

        return self::success(message: "Owner updated successfully", data: TenantResource::make($owner->load("building")));
    }

    public function destroy(User $owner)
    {
        $owner->building()->delete();
        $owner->delete();
        return self::success(message: "Owner deleted successfully");
    }
}
