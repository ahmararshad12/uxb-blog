<?php

namespace App\BlogApp\Base;

use App\BlogApp\Services\Post\PostService;
use App\Http\Controllers\Controller as BaseController;
use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

abstract class Controller extends BaseController
{
    public function __construct(protected PostService $service){

    }
    public function list()
    {
        //Todo: Handle HttpMethodNotFound and other exceptions
        $posts = $this->service->list(pagination: true, filters: function(){
            return [
                'user_id' => Auth::id()
            ];
        });
        if(!request()->ajax()){
            return view($this->module . '.list', compact('posts'));
        }
        return response(['data' => ['status' => 200, 'posts' => $posts]], 200);
    }

    public function create(){
        return view('posts.create');
    }

    public function store(StorePostRequest $request){
        try {
            //Todo: Remove dependency of inserted data from request
            $request->merge(['user_id' => Auth::id()]);
            $post = $this->service->create($request->all());
            return redirect()->route('posts.list')->with('success', 'Post created successfully!');
        }
        catch (\Exception $exception){
            //Store exception into log file for debugging.
            return redirect()->route('posts.create')->with('error', 'Something went wrong!');
        }
    }

    public function show(Post $post){
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post){
        return view('posts.edit', compact('post'));
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
