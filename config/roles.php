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
];
