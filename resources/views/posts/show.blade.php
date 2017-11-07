@extends('layouts.main')

@section('title', ' | View Post')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <img src="{{ asset('images/' . $post->image) }}" alt="featured_image" width="750">
            <h1>{{ $post->title }}</h1>
            <p class="lead">{!! $post->body !!}</p>
            <hr />
            <div class="tags">
                @foreach($post->tags as $tag)
                    <span class="label label-default">{{ $tag->name }}</span>
                @endforeach
            </div>

            @if($post->comments()->count() > 0)
            <div id="backend-comments btn-h1-spacing">
                <h3>Comment {{ $post->comments()->count() }} in total</h3>

                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Comment</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($post->comments as $comment)
                        <tr>
                            <td>{{ $comment->name }}</td>
                            <td>{{ $comment->email }}</td>
                            <td>{{ $comment->comment }}</td>
                            <td>
                                <a href="{{ route('comments.edit', $comment->id) }}" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-pencil"></span></a>
                                <a href="{{ route('comments.delete', $comment->id) }}" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif

        </div>

        <div class="col-md-4">
            <div class="well">
                <dl class="dl-horizontal">
                    <label>Url:</label>
                    <a href="{{ route('blog.single', $post->slug) }}">{{ route('blog.single', $post->slug) }}</a>
                </dl>
                <dl class="dl-horizontal">
                    <label>Category:</label>
                    <p>{{ $post->category->name }}</p>
                </dl>
                <dl class="dl-horizontal">
                    <label>Create At:</label>
                    <p>{{ dateFormatter('j M, Y H:i', $post->created_at) }}</p>
                </dl>
                <dl class="dl-horizontal">
                    <label>Last Updated:</label>
                    <p>{{ dateFormatter('j M, Y H:i', $post->updated_at) }}</p>
                </dl>
                <hr />
                <div class="row">
                    <div class="col-sm-6">
                        {!! link_to_route('posts.edit', 'Edit', array($post->id), array('class' => 'btn btn-primary btn-block')); !!}
                    </div>
                    <div class="col-sm-6">
                        {!! Form::open(['route' => ['posts.destroy', $post->id], 'method' => 'DELETE']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-block']) !!}
                        {!! Form::close() !!}
                    </div>
                    <div class="col-sm-12">
                        {!! link_to_route('posts.index', 'See All Posts', [], array('class' => 'btn btn-default btn-block btn-h1-spacing')); !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection