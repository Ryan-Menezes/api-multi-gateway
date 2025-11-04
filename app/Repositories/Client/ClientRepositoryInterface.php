<?php

declare(strict_types=1);

namespace App\Repositories\Client;
use App\Repositories\RepositoryInterface;

interface ClientRepositoryInterface extends RepositoryInterface
{
    public function findByIdWithTransactions(int|string $id): array|null;
}
