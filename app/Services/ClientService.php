<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\Client\ClientRepositoryInterface;

class ClientService implements ServiceInterface
{
    use BaseService;

    public function __construct(protected ClientRepositoryInterface $repository)
    {}
}
