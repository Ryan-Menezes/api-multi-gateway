<?php

namespace App\Utils;

use App\Enums\UserRoleEnum;
use Illuminate\Support\Facades\Gate;

abstract class UserRoleUtil
{
    public static function getAllRoles(): array
    {
        return [
            UserRoleEnum::ADMIN->value,
            UserRoleEnum::MANAGER->value,
            UserRoleEnum::FINANCE->value,
            UserRoleEnum::USER->value,
        ];
    }

    public static function checkRoles(array $roles): bool
    {
        foreach ($roles as $role) {
            if (Gate::allows($role)) return true;
        }

        return false;
    }
}
