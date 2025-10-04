<?php

namespace App\Http\Controllers\Api;

use App\Filters\BillCategoryFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\BillCategory\CreateBillCategoryRequest;
use App\Http\Requests\BillCategory\UpdateBillCategoryRequest;
use App\Http\Resources\BillCategoryResource;
use App\Models\BillCategory;

class BillCategoryController extends Controller
{
    public function index(BillCategoryFilter $catFilter)
    {
        return BillCategoryResource::collection(
            BillCategory::filter($catFilter)->paginate()
        );
    }

    public function store(CreateBillCategoryRequest $request)
    {
        $billCat = BillCategory::create($request->validated());
        return self::success(message: "Bill Category added successfully", data: BillCategoryResource::make($billCat));
    }

    public function show(BillCategory $bill_category)
    {
        return BillCategoryResource::make($bill_category);
    }

    public function update(UpdateBillCategoryRequest $request, BillCategory $bill_category)
    {
        $bill_category->update($request->validated());
        return self::success(message: "Bill Category updated successfully", data: BillCategoryResource::make($bill_category));
    }

    public function destroy(BillCategory $bill_category)
    {
        $bill_category->delete();
        return self::success(message: "Bill Category deleted successfully");
    }
}