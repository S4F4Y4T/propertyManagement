<?php

namespace App\Observers;

use App\Enums\PaymentStatusEnum;
use App\Mail\BillCreatedMail;
use App\Mail\BillPaidMail;
use App\Models\Bill;
use Illuminate\Support\Facades\Mail;

class BillObserver
{
    /**
     * Handle the Bill "created" event.
     */
    public function created(Bill $bill): void
    {
        $bill = $bill->load(['tenant','category']);

        if ($bill->tenant?->email) {
            Mail::to($bill->tenant->email)->queue(new BillCreatedMail($bill));
        }
    }

    /**
     * Handle the Bill "updated" event.
     */
    public function updated(Bill $bill): void
    {
        $bill = $bill->load(['tenant','category']);

        if ($bill->payment_status === PaymentStatusEnum::PAID->value) {

            if ($bill->tenant?->email) {
                Mail::to($bill->tenant->email)->queue(new BillPaidMail($bill));
            }
        }
    }

    /**
     * Handle the Bill "deleted" event.
     */
    public function deleted(Bill $bill): void
    {
        //
    }

    /**
     * Handle the Bill "restored" event.
     */
    public function restored(Bill $bill): void
    {
        //
    }

    /**
     * Handle the Bill "force deleted" event.
     */
    public function forceDeleted(Bill $bill): void
    {
        //
    }
}
