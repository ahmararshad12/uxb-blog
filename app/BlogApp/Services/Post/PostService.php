<?php

namespace App\BlogApp\Services\Post;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class PostService
{
    public function __construct(
        protected Model $model
    ){

    }
    public function list(bool $pagination = false, Callable $filters): Collection|LengthAwarePaginator
    {
        $query = $this->model::query();
        $query->where($filters());
        if($pagination){
            return $query->paginate(2);
        }
        return $query->get();
    }

    public function create(array $data): Model
    {
        return $this->model::query()->create($data);
    }

    public function update(array $data, int $id): int
    {
        return $this->model::query()->find($id)->update($data);
    }

}
