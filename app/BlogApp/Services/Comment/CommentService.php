<?php

namespace App\BlogApp\Services\Comment;

use App\BlogApp\Base\Service;
use App\Models\Comment;

class CommentService extends Service
{
    protected string $module = 'post';
    protected string $model = Comment::class;
}
