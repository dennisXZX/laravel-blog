@extends('main')

@section('title', ' | Edit Blog Post')

@section('stylesheets')
    {{-- Select2 CSS --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
    <div class="row">
        {{-- bind a Post model to the form --}}
        {!! Form::model($post, ['route' => ['posts.update', $post->id], 'method' => 'PUT']) !!}
        <div class="col-md-8">
            {{ Form::label('title', 'Title:') }}
            {{ Form::text('title', null, ['class' => 'form-control']) }}

            {{ Form::label('slug', 'Slug:', ['class' => 'form-spacing-top']) }}
            {{ Form::text('slug', null, ['class' => 'form-control']) }}

            {{ Form::label('category_id', 'Category:', ['class' => 'form-spacing-top']) }}
            {{ Form::select('category_id', $categoriesArray, $post->category_id, ['class' => 'form-control']) }}

            {{ Form::label('tags', 'Tags:', ['class' => 'form-spacing-top']) }}
            {{ Form::select('tags[]', $tagsArray, null, ['class' => 'form-control select2-multi', 'multiple' => 'multiple']) }}

            {{ Form::label('body', 'Body:', ['class' => 'form-spacing-top']) }}
            {{ Form::textarea('body', null, ['class' => 'form-control']) }}
        </div>
        <div class="col-md-4">
            <div class="well">
                <dl class="dl-horizontal">
                    <dt>Create At:</dt>
                    <dd>{{ dateFormatter('j M, Y H:i', $post->created_at) }}</dd>
                </dl>
                <dl class="dl-horizontal">
                    <dt>Last Updated:</dt>
                    <dd>{{ dateFormatter('j M, Y H:i', $post->updated_at) }}</dd>
                </dl>
                <hr />
                <div class="row">
                    <div class="col-sm-6">
                        {{ Form::submit('Save Changes', ['class' => 'btn btn-success btn-block']) }}
                    </div>
                    <div class="col-sm-6">
                        {!! link_to_route('posts.show', 'Cancel', array($post->id), array('class' => 'btn btn-danger btn-block')); !!}

                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection

@section('scripts')
    {{-- Select2 library --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>

    <script>
        $('.select2-multi').select2();
    </script>
@endsection