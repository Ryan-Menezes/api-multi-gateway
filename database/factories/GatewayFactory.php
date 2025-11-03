<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Gateway>
 */
class GatewayFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->sentence(1),
            'is_active' => fake()->boolean(),
            'priority' => fake()->numberBetween(0, 100),
        ];
    }
}
