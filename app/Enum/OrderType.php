<?php

namespace App\Enum;

class OrderType
{
    const REVERSAL = 0;
    const ENERGY = 1;
    const CASHOUT = 2;
    const DEPOSIT = 3;
    const AIRTIME = 4;
    const DSTV = 5;
    const GOTV = 6;
    const TRANSFER = 7;
    const STARTIMES = 8;
    const DATA = 9;
    const BET = 10;
    const CASHCALL = 11;
    const COMMISSION = 12;
    const COMMISSION_WITHDRAWAL = 13;
    const AGENT_COMMISSION_WITHDRAWAL = 14;
    const CREDIT_WALLET = 15;
    const VIRTUAL_ACCOUNT = 16;

    const MTN_ = 'MTN';
    const AIRTEL_ = 'AIRTEL';
    const GLO_ = 'GLO';
    const ETISALAT_ = '9MOBILE';
    const TRANSFER_ = 'Transfer';
    const IKEDC_ = 'IKEDC';
    const EKEDC_ = 'EKEDC';
    const IBEDC_ = 'IBEDC';
    const PE_ = 'PE';
    const EEDC_ = 'EEDC';
    const AEDC_ = 'AEDC';
    const JEDC_ = 'JEDC';
    const KEDCO_ = 'KEDCO';
    const KEDC_ = 'KEDC';
    const GOTV_ = 'GOTV';
    const DSTV_ = 'DSTV';
    const STARTIMES_ = 'STARTIMES';
    const CASHOUT_ = 'Cashout';
    const AIRTIME_ = 'Airtime';
    const DATA_ = 'Data';
    const ENERGY_ = 'Energy';
    const CABLE_ = 'Cable';
    const ISW_ = 'ISW';
    const LUX_ = 'LUX';
    const BET_ = "Bet";
    const AGENT_COMMISSION_WITHDRAWAL_ = 'Agent Commission Withdrawal';
    const CREDIT_WALLET_ = 'Credit Wallet';

    const BET9JA = 'Bet9ja';
    const NAIRABET = 'NairaBet';
    const ONEXBET = '1xBet';
    const BETKING = 'BetKing';
    const BETWAY = 'BetWay';
    const BANGBET = 'BangBet';
    const MERRYBET = 'MerryBet';
    const DEPOSIT_ = "Deposit";
    const VIRTUALACCOUNT = "VirtualAccount";
    const SAREPAY = "Sarepay";
    const BELLBASS = "BellBASS";
    const VFD = "VFD";

    /**
     * @return int[]
     */
    public static function types(): array
    {
        return [
            'ENERGY' => 1,
            'CASHOUT' => 2,
            'DEPOSIT' => 3,
            'AIRTIME' => 4,
            'DSTV' => 5,
            'GOTV' => 6,
            'TRANSFER' => 7,
            'STARTIMES' => 8,
            'DATA' => 9,
            'BET' => 10,
            'CASHCALL' => 11,
            'COMMISSION' => 12,
            'COMMISSION_WITHDRAWAL' => 13,
            'REVERSAL' => 0
        ];
    }

    public static array $transactionTypes = [
        self::AIRTIME_, self::DATA_, self::ENERGY_, self::CABLE_, self::TRANSFER_, self::CASHOUT_, self::BET_, self::VIRTUALACCOUNT
    ];

    public static array $serviceTypes = [
        self::AIRTIME_ => [
            self::MTN_, self::AIRTEL_, self::GLO_, self::ETISALAT_
        ],
        self::DATA_ => [
            self::MTN_, self::AIRTEL_, self::GLO_, self::ETISALAT_
        ],
        self::CABLE_ => [
            self::DSTV_, self::GOTV_, self::STARTIMES_
        ],
        self::BET_ => [
            self::BET9JA, self::NAIRABET, self::ONEXBET, self::BETKING, self::BETWAY, self::BANGBET, self::MERRYBET
        ],
        self::ENERGY_ => [
            self::EKEDC_, self::IKEDC_, self::IBEDC_, self::KEDCO_, self::EEDC_, self::PE_, self::AEDC_, self::JEDC_, self::KEDC_
        ],
        self::TRANSFER_ => [
            self::TRANSFER_
        ],
        self::CASHOUT_ => [
            self::ISW_, self::LUX_
        ],
        self::VIRTUALACCOUNT => [
            self::VIRTUALACCOUNT
        ]
    ];
}
