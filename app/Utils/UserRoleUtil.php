<?php

namespace App\Utils;

use App\Enums\UserRoleEnum;

abstract class UserRoleUtil
{
    public static function getAllRoles()
    {
        return [
            UserRoleEnum::ADMIN->value,
            UserRoleEnum::MANAGER->value,
            UserRoleEnum::FINANCE->value,
            UserRoleEnum::USER->value,
        ];
    }
}
