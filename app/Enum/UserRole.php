<?php

namespace App\Enum;

class UserRole
{
    const AGENT = 'Agent';
    const RESELLER = 'Reseller';
    const API = 'API';

    /**
    * @var string[]
    */
    public static array $userRoles = [
        self::AGENT, self::RESELLER, self::API
    ];
}