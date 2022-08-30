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
                        <section>
                            <div class="container my-2 py-2">
                                <div class="row d-flex justify-content-center">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex flex-start align-items-center">
                                                    <img class="rounded-circle shadow-1-strong me-3"
                                                         src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(19).webp" alt="avatar" width="60"
                                                         height="60" />
                                                    <div>
                                                        <h6 class="fw-bold text-primary mb-1">{{ $post->user->name }}</h6>
                                                        <p class="text-muted small mb-0">
                                                            Shared publicly - {{ $post->created_at }}
                                                        </p>
                                                    </div>
                                                </div>

                                                <div class="mt-3 mb-4 pb-2">
                                                    <h5>{{ $post->title }}</h5>
                                                    <p>{{ $post->description }}</p>
                                                </div>
                                            </div>
                                            <comments-component post_id="{{ $post->id }}" user="{{ auth()->user() }}" logged_in="{{ auth()->check() }}"></comments-component>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
