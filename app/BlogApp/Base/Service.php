<?php

namespace App\BlogApp\Base;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class Service
{
    private $query;

    /**
     * @param array $relations
     * @param string $orderByColumn
     * @param string $direction
     */
    public function __construct(
        private array $relations = [],
        private string $orderByColumn = 'created_at',
        private string $direction = 'ASC',
    ){
        $this->query = $this->model::query();
    }

    /**
     * @param bool $pagination
     * @param array $filters
     * @return Collection|LengthAwarePaginator
     */
    public function list(bool $pagination = false, array $filters = []): Collection|LengthAwarePaginator
    {
        $this->query->with($this->relations)->where($filters)->orderBy($this->orderByColumn, $this->direction);

        if($pagination){
            return $this->query->paginate(2);
        }
        return $this->query->get();
    }

    /**
     * @param array $data
     * @return Model
     */
    public function create(array $data): Model
    {
        return $this->query->create($data);
    }

    /**
     * @param array $data
     * @param int $id
     * @return int
     */
    public function update(array $data, int $id): int
    {
        return $this->query->find($id)->update($data);
    }

    /**
     * @param int $id
     * @return Model
     */
    public function show(int $id): Model
    {
        return $this->query->with($this->relations)->find($id);
    }

    /**
     * @param array $relations
     * @return $this
     */
    public function relations(array $relations): self
    {
        $this->relations = $relations;
        return $this;
    }

    /**
     * @param string $column
     * @param string $dir
     * @return $this
     */
    public function orderBy(string $column = 'created_at', string $dir = 'ASC'): self
    {
        $this->orderByColumn = $column;
        $this->direction = $dir;
        return $this;
    }
}
