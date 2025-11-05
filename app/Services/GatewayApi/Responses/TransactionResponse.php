<?php

namespace App\Services\GatewayApi\Responses;

class TransactionResponse
{
    public function __construct(
        public readonly string $id,
        public readonly int $amount,
        public readonly string $status,
        public readonly string $card_last_numbers,
        public readonly string $clientName,
        public readonly string $clientEmail
    ) {}
}
