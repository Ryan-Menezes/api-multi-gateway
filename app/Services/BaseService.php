<?php

declare(strict_types=1);

namespace App\Services;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

trait BaseService
{
    public function findAll(array $fields = ['*'],string $column = 'id',string $order = 'DESC'): array
    {
        return $this->repository->findAll($fields,$column,$order);
    }

    public function findAllPaginate(int $limit = 15, array $fields = ['*']): array
    {
        return $this->repository->findAllPaginate($limit, $fields);
    }

    public function findById(int|string $id): array
    {
        $result = $this->repository->findById($id);

        if (!$result) throw new NotFoundHttpException('Not found');

        return $result;
    }

    public function findByIdWithRelations(int|string $id, array $relations = []): array|null
    {
        $result = $this->repository->findByIdWithRelations($id, $relations);

        if (!$result) throw new NotFoundHttpException('Not found');

        return $result;
    }

    public function create(array $data): array
    {
        return $this->repository->create($data);
    }

    public function update(int|string $id, array $data): bool
    {
        $result = $this->findById($id);

        return $this->repository->update($result['id'], $data);
    }

    public function delete(int|string $id): bool
    {
        $result = $this->findById($id);

        return $this->repository->delete($result['id']);
    }
}
