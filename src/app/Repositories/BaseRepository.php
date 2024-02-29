<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements BaseRepositoryContract
{
    public function store(array $data): Model
    {
        return $this->model->create($data);
    }

    public function all(): array
    {
        return $this->model->get()->toArray();
    }

    public function getWithRelation(string $relation)
    {
        return $this->model->with($relation)->get();
    }

    public function getByAttribute(string $field, string $attribute): Collection
    {
        return $this->model->where($field, $attribute)->get();
    }
}
