<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\Transaction\TransactionRepositoryInterface;

class TransactionService implements ServiceInterface
{
    use BaseService;

    public function __construct(protected TransactionRepositoryInterface $repository)
    {}
}
