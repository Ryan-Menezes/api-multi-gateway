<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\Gateway\GatewayRepositoryInterface;

class GatewayService implements ServiceInterface
{
    use BaseService;

    public function __construct(protected GatewayRepositoryInterface $repository)
    {}

    public function toggleIsActive(int|string $id): void
    {
        $gateway = $this->findById($id);

        $this->repository->update($id, [
            'is_active' => !$gateway['is_active'],
        ]);
    }
}
