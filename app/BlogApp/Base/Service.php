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
    ){
        $this->query = $this->model::query();
    }

    //Todo: Set filters using chain
    public function list(bool $pagination = false, array $filters = []): Collection|LengthAwarePaginator
    {
        $this->query->with($this->relations)->where($filters);
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
}
