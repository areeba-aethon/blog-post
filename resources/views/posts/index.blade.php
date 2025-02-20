@extends('layouts.app')

@section('title', 'All Posts')

@section('content')
    <h1>All Posts</h1>

    <a href="{{ route('posts.create') }}" class="btn btn-success mb-3">Create New Post</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($posts->count() > 0)
        @foreach ($posts as $post)
            <div class="card mb-3">
                <div class="card-body">
                    <h3>{{ $post->title }}</h3>
                    <p>{!!$post->content!!}</p>
                    @if ($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid  pb-3" width="300">
                    @endif
                    <br>
                    
                    <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary">View</a>
                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning">Edit</a>

                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach

       <div class="d-flex justify-content-center">
            {{ $posts->links() }}
        </div> 

    @else
        <p>No posts found.</p>
    @endif
@endsection


