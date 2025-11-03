<?php

namespace App\Enums;

enum TransactionStatusEnum: int
{
    case OPENED = 1;
    case PAID = 2;
    case REFOUNDED = 3;
    case CANCELED = 4;
}
