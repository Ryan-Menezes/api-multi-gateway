<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\User\UserRepositoryInterface;

class UserService implements ServiceInterface
{
    use BaseService;

    public function __construct(protected UserRepositoryInterface $repository)
    {}

    public function create(array $data): array
    {
        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }

        return $this->repository->create($data);
    }

    public function update(int|string $id, array $data): bool
    {
        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }

        return $this->repository->update($id, $data);
    }
}
