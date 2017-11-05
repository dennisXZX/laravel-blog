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

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @foreach($post->comments as $comment)
                <hr />
                <div class="comment">
                    <label>Name:</label>
                    <p>{{ $comment->name }}</p>
                    <label>Comment:</label>
                    <p>{{ $comment->comment }}</p>
                </div>
            @endforeach
        </div>
    </div>

    <div class="row">
        <div id="comment-form" class="col-md-8 col-md-offset-2 form-spacing-top">
            {{-- passing the post id to CommentsController so we know which post this comment belongs --}}
            {{ Form::open(['route' => ['comments.store', $post->id], 'method' => 'POST']) }}
            <div class="row">
                <div class="col-md-6">
                    {{ Form::label('name', 'Name:') }}
                    {{ Form::text('name', null, ['class' => 'form-control']) }}
                </div>

                <div class="col-md-6">
                    {{ Form::label('email', 'Email:') }}
                    {{ Form::text('email', null, ['class' => 'form-control']) }}
                </div>

                <div class="col-md-12 form-spacing-top">
                    {{ Form::label('comment', 'Comment:') }}
                    {{ Form::textarea('comment', null, ['class' => 'form-control', 'rows' => 6]) }}
                    {{ Form::submit('Add Comment', ['class' => 'btn btn-success btn-block form-spacing-top']) }}
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
@endsection