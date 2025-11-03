<?php

namespace Database\Seeders;

use App\Enums\UserRoleEnum;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'email' => 'admin@admin.com',
            'password' => bcrypt('123'),
            'role' => UserRoleEnum::ADMIN->value,
        ]);

        User::factory()->create([
            'email' => 'manager@manager.com',
            'password' => bcrypt('123'),
            'role' => UserRoleEnum::MANAGER->value,
        ]);

        User::factory()->create([
            'email' => 'finance@finance.com',
            'password' => bcrypt('123'),
            'role' => UserRoleEnum::FINANCE->value,
        ]);

        User::factory()->create([
            'email' => 'user@user.com',
            'password' => bcrypt('123'),
            'role' => UserRoleEnum::USER->value,
        ]);
    }
}
