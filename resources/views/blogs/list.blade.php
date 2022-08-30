@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Blogs') }}
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
                    @foreach($posts as $post)
                        <div class="card mt-3">
                            <div class="card-header">
                                {{ $post->title }}
                            </div>
                            <div class="card-body">
                                <p class="card-text">{{ $post->description }}</p>
                                <a href="{{ route('posts.show', ['post' => $post->id]) }}" class="btn btn-sm btn-primary">Read More</a>
                            </div>
                        </div>
                    @endforeach

                        <div class="mt-3 justify-content-center">
                            {{ $posts->links() }}
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
