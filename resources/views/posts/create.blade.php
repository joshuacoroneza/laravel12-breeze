@extends('layout')

@section('content')
    <h1>My Posts</h1>

    <a href="{{ route('posts.create') }}">+ New Post</a>

    @foreach($posts as $post)
        <div>
            <h2>{{ $post->title }}</h2>
            <p>{{ $post->content }}</p>
            <p><small>By: {{ $post->user->name }}</small></p>
        </div>
    @endforeach
@endsection
