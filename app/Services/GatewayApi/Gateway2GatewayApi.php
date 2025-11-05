<?php

namespace App\Services\GatewayApi;

use App\Exceptions\GatewayApiException;
use App\Services\GatewayApi\Requests\TransactionRequest;
use App\Services\GatewayApi\Responses\TransactionResponse;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class Gateway2GatewayApi implements GatewayApiInterface
{
    private readonly PendingRequest $http;

    public function __construct()
    {
        $baseUrl = trim(env('GATEWAY2_URL'), '/');
        $token = env('GATEWAY2_TOKEN');
        $secret = env('GATEWAY2_SECRET');

        $this->http = Http::baseUrl($baseUrl)
            ->withoutVerifying()
            ->asJson()
            ->withHeaders([
                'Gateway-Auth-Token' => $token,
                'Gateway-Auth-Secret' => $secret,
            ]);
    }

    /** @return array<\App\Services\GatewayApi\Responses\TransactionResponse> */
    public function getTransactions(): array
    {
        $response = $this->http->get('/transacoes');

        if ($response->failed()) throw new GatewayApiException($response->json());

        return $this->parseTransactionsJson($response->json('data'));
    }

    public function createTransaction(TransactionRequest $request): void
    {
        $response = $this->http->post('/transacoes', [
            'valor' => $request->amount,
            'nome' => $request->clientName,
            'email' => $request->clientEmail,
            'numeroCartao' => $request->card_number,
            'cvv' => $request->card_last_numbers,
        ]);

        if ($response->failed()) throw new GatewayApiException($response->json());
    }

    public function refundTransaction(string $id): void
    {
        $response = $this->http->post('/transacoes/reembolso', [
            'id' => $id,
        ]);

        if ($response->failed()) throw new GatewayApiException($response->json());
    }

    /** @return array<\App\Services\GatewayApi\Responses\TransactionResponse> */
    private function parseTransactionsJson(array $transactions): array
    {
        $newTransactions = [];

        foreach ($transactions as $transaction) {
            $newTransactions[] = new TransactionResponse(
                $transaction->id,
                $transaction->amount,
                $transaction->status,
                $transaction->card_last_numbers,
                $transaction->name,
                $transaction->email
            );
        }

        return $newTransactions;
    }
}
