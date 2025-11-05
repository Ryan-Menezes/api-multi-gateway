<?php

declare(strict_types=1);

namespace App\Repositories\Client;

use App\Models\Client;
use App\Repositories\Client\ClientRepositoryInterface;
use App\Repositories\BaseRepository;

class ClientRepository extends BaseRepository implements ClientRepositoryInterface
{
    public function __construct()
    {
        parent::__construct(new Client());
    }
}
