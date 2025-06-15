<?php

namespace App\Enum;

class AccountingType
{
    const CREDIT = 'Credit';
    const DEBIT = 'Debit';

    /**
    * @var array|string[]
    */
    public static array $accountTypes = [
        self::CREDIT, self::DEBIT
    ];
}