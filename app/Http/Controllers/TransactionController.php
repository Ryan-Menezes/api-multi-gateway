<?php

namespace App\Http\Controllers;

use App\Services\TransactionService;

class TransactionController extends Controller
{
    public function __construct(
        private TransactionService $transactionService,
    ) {}

    public function index()
    {
        $transactions = $this->transactionService->findAllPaginate();

        return $this->json($transactions, wrapper: false);
    }

    public function show(int|string $id)
    {
        $transaction = $this->transactionService->findByIdWithRelations($id, ['client', 'gateway', 'transactionProducts.product']);

        return $this->json($transaction);
    }

    public function refund(int|string $id)
    {
        $transaction = $this->transactionService->findById($id);

        // TODO: Enviar pedido de reembolso para a api

        return $this->success('Transaction refunded sucessfully');
    }
}
