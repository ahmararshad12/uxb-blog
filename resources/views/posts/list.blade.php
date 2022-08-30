@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('My Posts') }}
                    <a href="{{ route('posts.create') }}" class="btn btn-sm btn-success float-end">Create</a>
                </div>

                <div class="card-body">

                    <x-alert/>

                    @if($posts->count())
                            @foreach($posts as $post)
                                <div class="card mt-3">
                                    <div class="card-header">
                                        {{ $post->title }}
                                        <span class="float-end" style="font-size: 11px;">
                                            Created {{ $post->created_at->diffForHumans() }}
                                        </span>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text">{{ $post->short_description }}</p>
                                        <a href="{{ route('posts.show', ['post' => $post->id]) }}" class="btn btn-sm btn-primary">Read More</a>
                                        @can('update', $post)
                                            | <a href="{{ route('posts.edit', ['post' => $post->id]) }}" class="btn btn-sm btn-primary">Edit</a>
                                        @endcan
                                    </div>
                                </div>
                            @endforeach

                            <div class="mt-3 justify-content-center">
                                {{ $posts->links() }}
                            </div>
                    @else
                        <x-no-record-alert/>
                    @endif


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
