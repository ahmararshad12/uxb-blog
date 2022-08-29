<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function list(){
        $posts = Post::wherePublished(true)->get();
        return view('posts.list', compact('posts'));
    }

    public function create(){
        return view('posts.create');
    }

    public function store(StorePostRequest $request){
        try {
            $post = Post::create($request->all());
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
            if($post->update($request->all())){
                return redirect()->route('posts.list')->with('success', 'Post updated successfully!');
            }
            return redirect()->route('posts.create')->with('error', 'Something went wrong!');
        }
        catch (\Exception $exception){
            //Store exception into log file for debugging.
            return redirect()->route('posts.create')->with('error', 'Something went wrong!');
        }
    }
}
