<?php

namespace App\Utils;

use App\Enums\TransactionStatusEnum;

abstract class TransactionStatusUtil
{
    public static function getAllStatus()
    {
        return [
            TransactionStatusEnum::OPENED->value,
            TransactionStatusEnum::PAID->value,
            TransactionStatusEnum::REFOUNDED->value,
            TransactionStatusEnum::CANCELED->value,
        ];
    }
}
