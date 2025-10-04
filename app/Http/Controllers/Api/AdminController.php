<?php

namespace App\Http\Controllers\Api;

use App\Enums\RoleEnum;
use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        return response()->json([
                'total_owner' => User::owners()->count(),
                'total_tenant' => Tenant::count()
            ]);
    }
}