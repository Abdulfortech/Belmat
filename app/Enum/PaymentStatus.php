<?php

namespace App\Enum;

class PaymentStatus
{
    const REFUNDED = 'REFUNDED';
    const PENDING = 'PENDING';
    const OVERPAID = 'OVERPAID';
    const PARTIALLY_PAID = 'PARTIALLY_PAID';
    const PAID = 'PAID';
    const EXPIRED = 'EXPIRED';
    const FAILED = 'FAILED';
    const CANCELED = 'CANCELED';
    const SUCCESSFUL = 'SUCCESSFUL';
}
