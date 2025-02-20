{{-- @extends('layouts.app')

@section('title', 'Create Post')

@section('content')
    <h1>Create a New Post</h1>

    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" name="title" class="form-control mb-2" placeholder="Title" required>
        <textarea name="content" class="form-control mb-2" placeholder="Content" required></textarea>
        <input type="file" name="image" class="form-control mb-2">
        <button type="submit" class="btn btn-success">Create</button>
    </form>
   <a href="{{ route('posts.index') }}" class="btn btn-secondary mt-3">Back</a>
@endsection --}}



@extends('layouts.app') 

@section('title', 'Create Post')

@section('content')
    <h1>Create a New Post</h1>

    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" name="title" class="form-control mb-2" placeholder="Title" required>
        
        <!-- Quill Editor Container -->
        <div id="editor-container" role="presentation" style="height: 200px;"></div>

        <!-- Hidden Input to Store Quill Content -->
        <input type="hidden" name="content" id="quill-content">

        <input type="file" name="image" class="form-control mb-2">
        <button type="submit" class="btn btn-success">Create</button>
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