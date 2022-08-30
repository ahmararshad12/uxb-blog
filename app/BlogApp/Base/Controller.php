<?php

namespace App\BlogApp\Base;

use App\BlogApp\Services\Post\PostService;
use App\Http\Controllers\Controller as BaseController;
use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

abstract class Controller extends BaseController
{
    private string $moduleSingular;
    private string $modulePlural;
    public function __construct(protected Service $service){
        $this->moduleSingular = Str::plural($this->module, 1);
        $this->modulePlural = Str::plural($this->module, 2);
    }
    public function list()
    {
        //Todo: Handle HttpMethodNotFound and other exceptions
        ${$this->modulePlural} = $this->service->list(pagination: true, filters: function(){
            return [
                'user_id' => Auth::id()
            ];
        });

        return view($this->modulePlural . '.list', compact($this->modulePlural));
    }

    public function create()
    {
        return view($this->modulePlural . '.create');
    }

    public function store(StorePostRequest $request)
    {
        try {
            //Todo: Remove dependency of inserted data from request
            $request->merge(['user_id' => Auth::id()]);
            ${$this->moduleSingular} = $this->service->create($request->all());
            return redirect()->route($this->modulePlural . '.list')->with('success', $this->moduleSingular . ' created successfully!');
        }
        catch (\Exception $exception){
            //Store exception into log file for debugging.
            return redirect()->route($this->modulePlural . '.create')->with('error', 'Something went wrong!');
        }
    }

    public function show(Post $post){
        return view($this->modulePlural . '.show', compact($this->moduleSingular));
    }

    public function edit(Post $post){
        return view($this->modulePlural . '.edit', compact($this->moduleSingular));
    }

    public function update(UpdatePostRequest $request, Post $post){
        try {
            if($this->service->update($request->except('_token'), $post->id)){
                return redirect()->route($this->modulePlural . '.list')->with('success', $this->moduleSingular . ' updated successfully!');
            }
            return redirect()->route($this->modulePlural . '.edit')->with('error', 'Something went wrong!');
        }
        catch (\Exception $exception){
            //Store exception into log file for debugging.
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }
}
