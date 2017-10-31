@extends('main')

@section('title', ' | Create New Post')

@section('stylesheets')
    {{-- Parsley CSS --}}
    {!! Html::style('css/parsley.css') !!}

    {{-- Select2 CSS --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>Create New Post</h1>
            <hr />
            {{-- the route property specifies a named routes (php artisan route:list) --}}
            {{-- data-parsley-validate initiates the form validation --}}
            {{-- Blade {{  }} statements are automatically sent through PHP's htmlentities function to prevent XSS attacks. --}}
            {!! Form::open(['route' => 'posts.store', 'data-parsley-validate' => '']) !!}
                {{ Form::label('title', 'Title:') }}
                {{ Form::text('title', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }}

                {{ Form::label('slug', 'Slug:', ['class' => 'form-spacing-top']) }}
                {{ Form::text('slug', null, array('class' => 'form-control', 'required' => '', 'minlength' => '5', 'maxlength' => '255')) }}

                {{ Form::label('category_id', 'Category:', ['class' => 'form-spacing-top']) }}
                <select name="category_id" class="form-control">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>

                {{ Form::label('tags', 'Tags:', ['class' => 'form-spacing-top']) }}
                <select name="tags[]" class="form-control select2-multi" multiple="multiple">
                    @foreach($tags as $tag)
                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                    @endforeach
                </select>

                {{ Form::label('body', 'Post Body:', ['class' => 'form-spacing-top']) }}
                {{ Form::textarea('body', null, ['class' => 'form-control', 'required' => '']) }}

                {{
                    Form::submit('Create Post', ['class' => 'btn btn-success btn-lg btn-block',
                                                 'style' => 'margin-top: 20px;'])
                }}
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('scripts')
    {!! Html::script('js/parsley.min.js') !!}

    {{-- Select2 library --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>

    <script>
        $('.select2-multi').select2();
    </script>
@endsection