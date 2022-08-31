<?php

namespace App\Http\Controllers;

use App\BlogApp\Services\Post\PostService;
use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * @var PostService
     */
    protected PostService $service;

    /**
     * @param PostService $service
     */
    public function __construct(PostService $service){
        $this->service = $service;
    }

    public function list()
    {
        return $this->service->orderBy(dir: 'DESC')->listView(pagination: true, filters: ['user_id' => Auth::id()]);
    }

    public function create()
    {
        return $this->service->createView();
    }

    public function store(StorePostRequest $request)
    {
        try {
            $this->service->create($request->all());
            return redirect()->route('posts.list')->with('success', 'Post created successfully!');
        }
        catch (\Exception $exception){
            //Store exception into log file for debugging.
            return redirect()->route('posts.create')->with('error', 'Something went wrong!');
        }
    }

    public function show(Post $post){
        return $this->service->showView($post->id);
    }

    public function edit(Post $post){
        return $this->service->editView($post->id);
    }

    public function update(UpdatePostRequest $request, Post $post){
        try {
            if($this->service->update($request->except('_token'), $post->id)){
                return redirect()->route('posts.list')->with('success', 'Post updated successfully!');
            }
            return redirect()->route('posts.edit')->with('error', 'Something went wrong!');
        }
        catch (\Exception $exception){
            //Store exception into log file for debugging.
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

}
