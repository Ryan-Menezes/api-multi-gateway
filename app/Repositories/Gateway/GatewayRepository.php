<?php

declare(strict_types=1);

namespace App\Repositories\Gateway;

use App\Models\Gateway;
use App\Repositories\Gateway\GatewayRepositoryInterface;
use App\Repositories\BaseRepository;

class GatewayRepository extends BaseRepository implements GatewayRepositoryInterface
{
    public function __construct()
    {
        parent::__construct(new Gateway());
    }
}
