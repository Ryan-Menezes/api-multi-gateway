<?php

use App\Enums\UserRoleEnum;

return [
    'gateways' => [
        UserRoleEnum::USER->value,
    ],
    'users' => [
        UserRoleEnum::MANAGER->value,
    ],
    'products' => [
        UserRoleEnum::MANAGER->value,
        UserRoleEnum::FINANCE->value,
    ],
    'clients' => [
        UserRoleEnum::USER->value,
    ],
    'transactions' => [
        UserRoleEnum::USER->value,
    ],
    'transactions.refound' => [
        UserRoleEnum::FINANCE->value,
    ],
];
