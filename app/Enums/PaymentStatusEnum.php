<?php

namespace App\Enums;

enum PaymentStatusEnum: string
{
    case UNPAID = 'unpaid';
    case PAID = 'paid';
    case PARTIAL = 'partial';
}