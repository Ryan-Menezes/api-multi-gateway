<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\Client\ClientRepositoryInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ClientService implements ServiceInterface
{
    use BaseService;

    public function __construct(protected ClientRepositoryInterface $repository)
    {}

    public function findByIdWithTransactions(int|string $id): array|null
    {
        $client = $this->repository->findByIdWithTransactions($id);

        if (!$client) throw new NotFoundHttpException('Not found');

        return $client;
    }
}
