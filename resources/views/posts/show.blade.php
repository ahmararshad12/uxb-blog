@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Post') }}
                    @can('update', $post)
                    <a href="{{ route('posts.edit', ['post' => $post->id]) }}" class="btn btn-sm btn-success">Edit</a>
                    @endcan
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                    <post-show-component
                        post="{{ $post }}"
                        canUpdate="{{ auth()->user()->can('update', $post) }}"
                        current_user="{{ auth()->user() }}"
                    ></post-show-component>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
