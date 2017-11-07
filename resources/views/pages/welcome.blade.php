@extends('layouts.main')

@section('title', ' | Homepage')

@section('content')
    <!-- jumbotron row -->
    <div class="row">
        <div class="col-md-12">
            <div class="jumbotron">
                <h1>Hello, Welcome to my Blog</h1>
                <p class="lead">Thank you for being a part of my test blog</p>
            </div>
        </div>
    </div>

    <!-- post list row -->
    <div class="row">
        <!-- post list column -->
        <div class="col-md-12">
            @foreach($posts as $post)
                <div class="post">
                    <h3>{{ $post->title }}</h3>
                    <p>{{ substr(strip_tags($post->body), 0, 300) }}{{ hasEllipsis(strip_tags($post->body), 300) }}</p>
                    <a href="{{ route('blog.single', $post->slug) }}" class="btn btn-primary">Read more</a>
                </div>
            @endforeach
        </div>
    </div>
@endsection