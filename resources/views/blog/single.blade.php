@extends('layouts.main')

{{-- escape the HTML title XSS attack --}}
<?php $title = htmlspecialchars($post->title) ?>

@section('title', "| $title")

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>{{ $post->title }}</h1>
            <p>{{ $post->body }}</p>
            <hr />
            <p>Category: {{ $post->category->name }}</p>
        </div>
    </div>
@endsection