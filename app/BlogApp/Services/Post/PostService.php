<?php

namespace App\BlogApp\Services\Post;

use App\BlogApp\Base\Service;
use App\BlogApp\Interfaces\ServiceInterface;
use App\BlogApp\Traits\HasCrudViews;
use App\Models\Post;

class PostService extends Service
{
    use HasCrudViews;

    protected string $module = 'post';
    protected string $model = Post::class;
}
