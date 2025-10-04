<?php

namespace App\Http\Controllers\Api;

use App\Enums\PaymentStatusEnum;
use App\Filters\BillFilter;
use App\Http\Controllers\Controller;
use App\Http\Resources\BillResource;
use App\Models\Bill;
use App\Models\Flat;
use App\Http\Requests\Bill\CreateBillRequest;
use App\Services\BillService;

class BillController extends Controller
{
    private BillService $billService;

    public function __construct(BillService $billService)
    {
        $this->billService = $billService;
    }

    public function index(BillFilter $billFilter)
    {
        return BillResource::collection(
            Bill::filter($billFilter)->paginate()
        );
    }

    public function store(CreateBillRequest $request, Flat $flat)
    {
        $createdBills = $this->billService->createBill($flat, $request->validated()['bills']);

        return BillResource::collection(collect($createdBills));
    }

    public function show(Bill $bill)
    {
        return BillResource::make($bill);
    }

    public function destroy(Bill $bill)
    {
        $bill->delete();
        return self::success(message: "Bill deleted successfully");
    }

    public function pay(Bill $bill)
    {
        // if ($bill->payment_status === PaymentStatusEnum::PAID->value) {
        //     return self::error(message: "Bill is already paid", code: 400);
        // }

        $bill->update(['payment_status' => PaymentStatusEnum::PAID->value, 'paid_amount' => $bill->total_amount]);
        return self::success(message: "Bill paid successfully", data: BillResource::make($bill));
    }
}