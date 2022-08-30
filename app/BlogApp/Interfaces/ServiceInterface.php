<?php

namespace App\BlogApp\Interfaces;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface ServiceInterface
{
    public function list(bool $pagination = false, Callable $filters): Collection|LengthAwarePaginator;

    public function create(array $data): Model;

    public function update(array $data, int $id): int;
}
