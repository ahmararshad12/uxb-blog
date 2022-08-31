<?php

namespace App\BlogApp\Traits;

use Illuminate\View\View;

trait HasCrudViews
{
    public function listView(bool $pagination = false, array $filters = [], string $orderByColumn='created_at', $direction='ASC'): View
    {
        ${plural($this->module)} = $this->list(pagination: $pagination, filters: $filters);
        return view(plural($this->module) . '.list', compact(plural($this->module)));
    }

    public function createView(): View
    {
        return view(plural($this->module) . '.create');
    }

    public function showView(int $id): View
    {
        ${$this->module} = $this->relations(['user'])->show($id);
        return view(plural($this->module) . '.show', compact($this->module));
    }

    public function editView(int $id): View
    {
        ${$this->module} = $this->show($id);
        return view(plural($this->module) . '.edit', compact($this->module));
    }
}
