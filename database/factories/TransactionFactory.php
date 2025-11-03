<?php

namespace Database\Factories;

use App\Enums\TransactionStatusEnum;
use App\Models\Client;
use App\Models\Gateway;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'client_id' => Client::query()->inRamdomOrder()->first()?->id ?? Client::factory()->create()->id,
            'gateway_id' => Gateway::query()->inRamdomOrder()->first()?->id ?? Gateway::factory()->create()->id,
            'external_id' => fake()->uuid(),
            'status' => fake()->randomElement([
                TransactionStatusEnum::OPENED->value,
                TransactionStatusEnum::PAID->value,
                TransactionStatusEnum::REFOUNDED->value,
                TransactionStatusEnum::CANCELED->value,
            ]),
            'amount' => fake()->numberBetween(100, 10000),
            'card_last_numbers' => fake()->numberBetween(111, 999),
        ];
    }
}
