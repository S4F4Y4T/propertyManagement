<?php

namespace App\Http\Controllers\Api;

use App\Filters\TenantFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\CreateTenantRequest;
use App\Http\Requests\Tenant\UpdateTenantRequest;
use App\Http\Resources\TenantResource;
use App\Models\Tenant;
use App\Services\TenantService;

class TenantController extends Controller
{
    private TenantService $tenantService;

    public function __construct(TenantService $tenantService)
    {
        $this->tenantService = $tenantService;
    }

    public function index(TenantFilter $tenantFilter)
    {
        return TenantResource::collection(
            Tenant::filter($tenantFilter)->paginate()
        );
    }

    public function store(CreateTenantRequest $request)
    {
        $tenant = $this->tenantService->createTenant($request->validated());

        return self::success(message: "Tenant added successfully", data: TenantResource::make($tenant));
    }

    public function show(Tenant $tenant)
    {
        return TenantResource::make($tenant);
    }

    public function update(UpdateTenantRequest $request, Tenant $tenant)
    {
        $tenant = $this->tenantService->updateTenant($tenant, $request->validated());
        return self::success(message: "Tenant updated successfully", data: TenantResource::make($tenant));
    }

    public function destroy(Tenant $tenant)
    {
        $tenant = $this->tenantService->deleteTenant($tenant);
        return self::success(message: "Tenant deleted successfully");
    }
}