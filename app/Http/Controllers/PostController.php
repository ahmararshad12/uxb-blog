<?php

namespace App\Http\Controllers;

use App\BlogApp\Base\Controller;
use App\BlogApp\Services\Post\PostService;
use App\Models\Post;

class PostController extends Controller
{
    protected string $module = 'posts';
    public function __construct(){
        parent::__construct(new PostService(new Post()));
    }


}
