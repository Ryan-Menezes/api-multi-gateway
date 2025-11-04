<?php

namespace App\Http\Controllers;

use App\Services\ClientService;

class ClientController extends Controller
{
    public function __construct(
        private ClientService $clientService,
    ) {}

    public function index()
    {
        $clients = $this->clientService->findAllPaginate();

        return $this->json($clients, wrapper: false);
    }

    public function show(int|string $id)
    {
        $client = $this->clientService->findByIdWithTransactions($id);

        return $this->json($client);
    }
}
