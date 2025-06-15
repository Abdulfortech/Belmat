<?php

namespace App\Enum;

class TransactionStatus
{
    const QUEUED = 'Queued';
    const REFUNDED = 'Refunded';
    const PAID = 'Paid';
    const INITIATED = 'Initiated';
    const PENDING = 'Pending';
    const SUCCESSFUL = 'Successful';
    const FAILED = 'Failed';
    const ACTIVE = "Active";
    const INACTIVE = "Inactive";
    const SETTLED = 'Settled';
}
