<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Repositories\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements RepositoryInterface
{
    public function __construct(protected Model $model)
    {}

    public function findAll(array $fields = ['*'], string $column = 'id', string $order = 'DESC'): array
    {
        return $this->model->select($fields)->orderBy($column,$order)->get()->toArray();
    }

    public function findAllPaginate(int $limit = 15, array $fields = ['*']): array
    {
        return $this->model->select($fields)->paginate($limit)->toArray();
    }

    public function findById(int|string $id): array|null
    {
        return $this->model->find($id)?->toArray();
    }

    public function findByIdWithRelations(int|string $id, array $relations = []): array|null
    {
        $model = $this->model->find($id);

        if (!$model) return null;
        if (!empty($relations)) $model->load($relations);

        return $model?->toArray();
    }

    public function create(array $data): array
    {
        return $this->model->create($data)->toArray();
    }

    public function update(int|string $id, array $data): bool
    {
        return (bool) $this->model->find($id)?->update($data);
    }

    public function delete(int|string $id): bool
    {
        return (bool) $this->model->find($id)?->delete();
    }
}
