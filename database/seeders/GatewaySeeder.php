<?php

namespace Database\Seeders;

use App\Models\Gateway;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GatewaySeeder extends Seeder
{
    public function run(): void
    {
        Gateway::factory()->create([
            'name' => 'gateway-1',
            'is_active' => true,
            'priority' => 0,
        ]);

        Gateway::factory()->create([
            'name' => 'gateway-2',
            'is_active' => true,
            'priority' => 1,
        ]);
    }
}
