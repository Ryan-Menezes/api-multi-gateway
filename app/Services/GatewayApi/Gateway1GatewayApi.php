<?php

namespace App\Services\GatewayApi;

use App\Exceptions\GatewayApiException;
use App\Services\GatewayApi\Requests\TransactionRequest;
use App\Services\GatewayApi\Responses\TransactionResponse;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class Gateway1GatewayApi implements GatewayApiInterface
{
    private readonly string $baseUrl;
    private readonly PendingRequest $http;

    public function __construct()
    {
        $this->baseUrl = trim(env('GATEWAY1_URL'), '/');

        $accessToken = $this->getJWTAccessToken();

        $this->http = Http::baseUrl($this->baseUrl)
            ->withoutVerifying()
            ->asJson()
            ->withToken($accessToken);
    }

    /** @return array<\App\Services\GatewayApi\Responses\TransactionResponse> */
    public function getTransactions(): array
    {
        $response = $this->http->get('/transactions');

        if ($response->failed()) throw new GatewayApiException($response->json());

        return $this->parseTransactionsJson($response->json('data'));
    }

    public function createTransaction(TransactionRequest $request): void
    {
        $response = $this->http->post('/transactions', [
            'amount' => $request->amount,
            'name' => $request->clientName,
            'email' => $request->clientEmail,
            'cardNumber' => $request->card_number,
            'cvv' => $request->card_last_numbers,
        ]);

        if ($response->failed()) throw new GatewayApiException($response->json());
    }

    public function refundTransaction(string $id): void
    {
        $response = $this->http->post("/transactions/{$id}/charge_back");

        if ($response->failed()) throw new GatewayApiException($response->json());
    }

    private function getJWTAccessToken(): string
    {
        $email = env('GATEWAY1_EMAIL');
        $token = env('GATEWAY1_TOKEN');

        $response = Http::withoutVerifying()
            ->asJson()
            ->post("{$this->baseUrl}/login", [
                'email' => $email,
                'token' => $token,
            ]);

        if ($response->failed()) throw new GatewayApiException($response->json());

        return $response->json('token');
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
