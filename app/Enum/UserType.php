<?php

namespace App\Enum;

class UserType
{
    const USER = 'User';
    const AGENT = 'Agent';
    const ADMIN = 'Admin';

    /**
    * @var string[]
    */
    public static array $agentTypes = [
        self::AGENT, self::USER, self::ADMIN
    ];
}