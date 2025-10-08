<x-mail::message>

Your bill has been paid.

- **Type:** {{ $bill->category->name }}
- **Month:** {{ \Carbon\Carbon::createFromFormat('Y-m', $bill->month)->format('F Y') }}
- **Total Amount:** {{ number_format($bill->total_amount, 2) }}
- **Status:** {{ ucfirst($bill->payment_status) }}

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
