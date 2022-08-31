<?php

namespace App\BlogApp\Base;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class Service
{
    private $query;

    public function __construct(
        private array $relations = [],
        private string $orderByColumn = 'created_at',
        private string $direction = 'ASC',
    ){
        $this->query = $this->model::query();
    }

    public function list(bool $pagination = false, array $filters = []): Collection|LengthAwarePaginator
    {
        $this->query->with($this->relations)->where($filters)->orderBy($this->orderByColumn, $this->direction);

        if($pagination){
            return $this->query->paginate(2);
        }
        return $this->query->get();
    }

    public function create(array $data): Model
    {
        return $this->query->create($data);
    }

    public function update(array $data, int $id): int
    {
        return $this->query->find($id)->update($data);
    }

    public function show(int $id): Model
    {
        return $this->query->with($this->relations)->find($id);
    }

    public function relations(array $relations): self
    {
        $this->relations = $relations;
        return $this;
    }

    public function orderBy(string $column = 'created_at', string $dir = 'ASC'): self
    {
        $this->orderByColumn = $column;
        $this->direction = $dir;
        return $this;
    }
}
