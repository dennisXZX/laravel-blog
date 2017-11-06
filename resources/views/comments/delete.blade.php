@extends('layouts.main')

@section('title', ' | Delete Comment')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h3>Are you sure you want to delete this comment?</h3>
            <div>
                Name: {{ $comment->name }}
            </div>
            <div>
                Email: {{ $comment->email }}
            </div>
            <div>
                Comment: {{ $comment->comment }}
            </div>

            {{ Form::open(['route' => ['comments.destroy', $comment->id], 'method' => 'DELETE']) }}
                {{ Form::submit('Delete', ['class' => 'btn btn-danger btn-block']) }}
            {{ Form::close() }}
</div>
</div>
@endsection