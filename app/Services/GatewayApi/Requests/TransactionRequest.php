<?php

namespace App\Services\GatewayApi\Requests;

class TransactionRequest
{
    public function __construct(
        public readonly int $amount,
        public readonly string $status,
        public readonly string $card_last_numbers,
        public readonly string $card_number,
        public readonly string $clientName,
        public readonly string $clientEmail
    ) {}
}
