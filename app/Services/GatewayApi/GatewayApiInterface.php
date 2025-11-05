<?php

namespace App\Services\GatewayApi;

use App\Services\GatewayApi\Requests\TransactionRequest;

interface GatewayApiInterface
{
    /** @return array<\App\Services\GatewayApi\Responses\TransactionResponse> */
    public function getTransactions(): array;
    public function createTransaction(TransactionRequest $request): void;
    public function refundTransaction(string $id): void;
}
