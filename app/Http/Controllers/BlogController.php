<?php

namespace App\Http\Controllers;

use App\BlogApp\Base\Service;
use App\BlogApp\Interfaces\ServiceInterface;
use App\BlogApp\Services\Post\PostService;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    protected PostService $postService;
    public function __construct(PostService $postService){
        $this->postService = $postService;
    }

    public function list()
    {
        return $this->postService->orderBy(dir: 'DESC')->listView(pagination: true);

//        return view('blogs.list', compact('posts'));
    }
}
