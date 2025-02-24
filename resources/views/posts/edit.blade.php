@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
    <h1>Edit Post</h1>

    <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="{{ $post->title }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Content</label>

        
            <div id="editor-container" style="height: 200px;">{!! $post->content !!}</div>

        
            <input type="hidden" name="content" id="quill-content">
        </div>

        <div class="mb-3">
            <label class="form-label">Current Image</label><br>
            @if ($post->image)
                <img src="{{ asset($post->image) }}" class="img-thumbnail mb-2" width="200">
            @endif
        </div>

        <div class="mb-3">
            <label class="form-label">Upload New Image</label>
            <input type="file" name="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Update Post</button>
    </form>

    <a href="{{ route('posts.index') }}" class="btn btn-secondary mt-3">Back</a>
@endsection

@push('scripts')

    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.0/dist/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.0/dist/quill.js"></script>

<script>
   document.addEventListener("DOMContentLoaded", function () {
    console.log("Quill is loading...");

    var quill = new Quill('#editor-container', {
        theme: 'snow',
        placeholder: 'Write your post content...',
        modules: {
            toolbar: [
                ['bold', 'italic', 'underline'],        
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                [{ 'script': 'sub'}, { 'script': 'super' }],
                [{ 'indent': '-1'}, { 'indent': '+1' }],
                [{ 'color': [] }, { 'background': [] }],
                ['link', 'video']
            ]
        }
    });

    console.log("Quill Editor Initialized:", quill);

    let hiddenInput = document.querySelector("#quill-content");

    
    quill.root.innerHTML = `{!! addslashes($post->content) !!}`;

    hiddenInput.value = quill.root.innerHTML.trim();

    quill.on('text-change', function () {
        hiddenInput.value = quill.root.innerHTML.trim();
    });

    document.querySelector("form").onsubmit = function (event) {
        if (!hiddenInput.value.trim()) {
            event.preventDefault(); 
            alert("Content cannot be empty!");
        }
    };
});
</script>
@endpush