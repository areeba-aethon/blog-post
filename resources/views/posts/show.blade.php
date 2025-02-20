@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <h1>{{ $post->title }}</h1>
    <h6 class="text-secondary">{{$post->created_at->format('d M Y')}}</h6>
    @if ($post->image)
        <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid mb-3">
    @endif
    <p>{!!$post->content!!}</p>
@endsection